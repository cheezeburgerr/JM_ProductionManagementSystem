<?php

namespace App\Livewire;

use App\Models\Lineup;
use Livewire\Component;
use Livewire\Attributes\On;
class ReturnData extends Component
{

    public $id;
    protected $listeners = ['artistAssigned' => 'refreshTable'];


    #[On('sendUnprint')]
    public function render()
    {

        $unprinted = Lineup::where('order_id', $this->id)->where('status', null)->get();
        return view('livewire.return-data', compact('unprinted'));
    }
}
