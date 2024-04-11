<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
class OrderDetails extends Component
{

    public $data;
    public $order;

    public function render()
    {

        $this->order = Order::leftJoin('order_details', 'orders.id', 'order_details.order_id')->leftJoin('production_details', 'orders.id', 'production_details.order_id')->where('orders.id', $this->data)->first();

        return view('livewire.order-details');
    }
}
