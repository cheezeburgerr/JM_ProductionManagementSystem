<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Products;
use GuzzleHttp\Psr7\Request;
use Livewire\Component;

class Orderform extends Component
{

    public $selectedOption;
    public $price;

    protected $listeners = ['updatePrice'];

    public function updatePrice()
    {
        // Logic to calculate price based on selected option
        // Assuming $this->selectedOption contains the selected option
        // You need to replace this with your actual logic
        $this->price = $this->selectedOption ? $this->selectedOption->price : 0;
    }

    public $products;

    public function mount($products)
    {
        $this->price = 0;
        $this->products = $products;

    }
    public function storeOrder(Request $request){


    }

    public function render()
    {


        return view('livewire.orderform');
    }
}
