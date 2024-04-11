<?php

namespace App\View\Components;

use App\Models\Order;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OrderDetail extends Component
{
    /**
     * Create a new component instance.
     */


    public $order;
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        $this->order = Order::leftJoin('order_details', 'orders.id', 'order_details.order_id')->leftJoin('production_details', 'orders.id', 'production_details.order_id')->where('orders.id', $this->order)->first();
        return view('components.order-detail');
    }
}
