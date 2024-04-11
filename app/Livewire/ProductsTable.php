<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
class ProductsTable extends Component
{
    use WithPagination;

    protected $debug = true;
    public $items;
    public $columns;
    public $perPage = 10;
    public $sortField;
    public $sortAsc = true;
    public $search = '';

    protected $listeners = ['refreshDataTable' => '$refresh'];

    public function mount($items, $columns)
    {
        $this->items = $items;
        $this->columns = $columns;
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }


    public function render()
    {

        $user = Auth::guard('employee')->user();

        $query = Order::query()->leftJoin('order_details', 'orders.id', 'order_details.order_id')->leftJoin('production_details', 'orders.id', 'production_details.production_details_id')->where('artist_id', $user->id);
        return view('livewire.products-table');
    }



    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }
}
