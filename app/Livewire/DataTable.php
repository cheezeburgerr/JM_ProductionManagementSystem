<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\ProductionDetails;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\On;
class DataTable extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $debug = true;

    public $perPage = 10;
    public $search = '';
    public $checkPending = false;
    public $withoutArtist = false;
    public $production = false;
    public $orderId;
    public $tableName = '';
    public $columns = [];

    protected $listeners = ['artistAssigned' => 'refreshTable', 'printerAssigned' => 'refreshTable'];

    public $selectedArtistId;
    //protected $listeners = ['refreshDataTable' => '$refresh'];

    // public function mount($search)
    // {
    //     $this->search = $search;

    // }

    public function assign($id){
        $order = ProductionDetails::where('order_id', $id)->get();
        foreach ($order as $detail) {
            // Update the attribute(s) you need to update
            $detail->artist_id = $this->selectedArtistId;

            // Save the changes to the database
            $detail->save();
            $this->dispatch('artistAssigned');
        }
       // dd($this->selectedArtistId, $id);

    }

    public function openModal($id)
    {
        $order = Order::leftJoin('order_details', 'orders.id', 'order_details.order_id')->leftJoin('production_details', 'orders.id', 'production_details.order_id')->where('orders.id', $id)->first();

        $category = Products::with(['options' => function ($query) {
            $query->withPivot('product_option_type');
        }])->get();
        //dd($product);

        $data = [
            'order' => $order,
            'category' => $category,
        ];

        $this->dispatch('openModal', $data);
    }

    #[On('artistAssigned')]

    public function updatingSearch()
    {
        $this->resetPage();
        // dd('check');
    }

    public function updateStatus($orderId)
    {
        // Update the status of the order
        $order = ProductionDetails::where('order_id', $orderId)->first();

        if ($order) {
            $order->update(['status' => 'Designing']); // Replace 'approved' with the desired status
        }

        // Emit an event to notify listeners
        $this->dispatch('statusUpdated');
    }

    public $sortField = ''; // Field to sort by
    public $sortAsc = true; // Sort direction (ascending by default)

    // Method to handle sorting
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            // If already sorting by this field, reverse the sort direction
            $this->sortAsc = !$this->sortAsc;
        } else {
            // If sorting by a new field, set it and default to ascending
            $this->sortField = $field;
            $this->sortAsc = true;
        }
    }



    public function render(Request $request)
    {
        $statusArray = ['Ready to Print', 'Printing', 'Printed'];

        $uri = Request::path();
        $user = Auth::guard('employee')->user();


        $query = Order::leftJoin('order_details', 'orders.id', 'order_details.order_id')->leftJoin('production_details', 'orders.id', 'production_details.order_id')->leftJoin('employees', 'production_details.artist_id', 'employees.employee_id');

        // Check if the user is an artist
        if ($user->department_id == '1') {

            if($this->withoutArtist){
                $query->where('artist_id', null);
            }
            else
            {
                $query->where('artist_id', $user->employee_id);
            }
            // dd($query->paginate(10), $this->tableName, $this->withoutArtist);
            $query->where('status', '!=', 'Pending');

        }
        if ($user->department_id == '2') {
            if ($this->checkPending) {
                $query->where('status', 'Pending');
            } else {
                $query->where('status', '!=', 'Pending');
            }

        }

        if ($user->department_id == '4') {


                $query->whereIn('status', $statusArray);

        }
        if (!empty($this->sortField)) {
            $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
        }

        if (!empty($this->search)) {
            $columns = '';
            $query->where(function ($q) use ($columns) {
                foreach ($this->columns as $column) {
                    $q->orWhere($column['field'], 'like', '%' . $this->search . '%');
                }
            });

        }


        $tableName = $this->tableName;
        $items = $query->paginate(10);
        // dd($items);


        return view('livewire.data-table', compact('items', 'tableName'));
    }
}
