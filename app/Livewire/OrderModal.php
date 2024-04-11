<?php

namespace App\Livewire;

use Livewire\Component;


class OrderModal extends Component
{
    public function render()
    {
        return view('livewire.order-modal');
    }
    public $order;
    public $category;
    public $showModal = false;

    protected $listeners = ['openModal'];


    public function openModal($data)
    {

        // $this->order = $order;
        $this->order = $data['order'];
        $this->category = $data['category'];



       //dd($this->category);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
}
