<?php

namespace App\Livewire;

use App\Models\Lineup;
use App\Models\Order;
use App\Models\ProductionDetails;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Request;
class PrintTable extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $debug = true;

    public $progress = '';
    public $perPage = 10;
    public $search = '';
    public $checkPending = false;
    public $orderId;
    public $lineup_id;
    public $id;
    public $status;

    //protected $listeners = ['refreshDataTable' => '$refresh'];

    // public function mount($search)
    // {
    //     $this->search =  $search;

    // }


    public function mount($id)
    {
        // Load initial status from the database
        $order = ProductionDetails::where('order_id', $id)->first();
        $this->status = $order->status ?? 'Not Started';
    }
    public function toggleStatus($lineupID)
    {
        $order = Lineup::find($lineupID);

        $order->status = !$order->status; // Toggle the status
        // If checked, set the status to "printed", otherwise reset it
        $order->status = $order->status ? 'Printed' : null;
        $order->save();

        $this->updateProgress();

    }

    public function togglePrinting()
    {
        $order = ProductionDetails::where('order_id', $this->id)->first();

        // Toggle the status
        $this->status = $this->status === 'Printing' ? 'Printed' : 'Printing';

        // Update the status column in the database
        $order->update(['status' => $this->status]);

        $this->dispatch('sendUnprint');
    }

    public function getUnprint(){

    }

    public function updateProgress(){


        $finished = Lineup::where('order_id', $this->id)->where('status', 'Printed')->count();
       $total = Lineup::where('order_id', $this->id)->count();
       $progressPercentage = $total > 0 ? ($finished / $total) * 100 : 0;

       $order = ProductionDetails::where('order_id', $this->id)->first();


        $order->progress = $progressPercentage;
        $order->save();

       $this->progress = $progressPercentage;

    }
    public function updatedSearch()
    {
        $this->resetPage();
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

    public function render()
    {


        //dd($this->id);

        $order = Order::leftJoin('order_details', 'orders.id', 'order_details.order_id')->leftJoin('production_details', 'orders.id', 'production_details.order_id')->where('orders.id', $this->id)->first();
        $user = Auth::guard('employee')->user();

        $this->progress = $order->progress;

        $query = Lineup::query()->where('order_id', $this->id);

        $count = Lineup::query()->where('order_id',$this->id)->count();

        //dd($count);
        $columns = [
            ['title' => 'Name', 'field' => 'player_name'],
            ['title' => 'Details', 'field' => 'player_details'],
            ['title' => 'Classification', 'field' => 'classification'],
            ['title' => 'Gender', 'field' => 'gender'],
            ['title' => 'Upper Size', 'field' => 'upper_size'],
            ['title' => 'Short Size', 'field' => 'short_size'],
            ['title' => 'Short Name', 'field' => 'short_name']
            // Add more columns as needed
        ];
        if (!empty($this->sortField)) {
            $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
        }

        if (!empty($this->search)) {
            $query->where(function ($q) use ($columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column['field'], 'like', '%' . $this->search . '%');
                }
            });
        }


        $items = $query->paginate(10);
        // dd($items);

        return view('livewire.print-table', compact('items', 'columns', 'count', 'order'));
    }
}
