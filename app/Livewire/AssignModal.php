<?php

namespace App\Livewire;

use App\Models\ProductionDetails;
use Livewire\Component;

class AssignModal extends Component
{

    public $id;
    public $selectedArtistId;
    public $selectedPrinterId;
    public $mode;
    public function assign(){


        $order = ProductionDetails::where('order_id', $this->id)->get();
        foreach ($order as $detail) {
            // Update the attribute(s) you need to update
            $detail->artist_id = $this->selectedArtistId;

            // Save the changes to the database
            $detail->save();
            $this->dispatch('artistAssigned');
        }
       // dd($this->selectedArtistId, $id);

    }

    public function proceed(){


        $order = ProductionDetails::where('order_id', $this->id)->get();
        foreach ($order as $detail) {
            // Update the attribute(s) you need to update
            $detail->printer_id = $this->selectedPrinterId;
            $detail->status = 'Ready to Print';
            // Save the changes to the database
            $detail->save();
            $this->dispatch('printerAssigned');
        }
       // dd($this->selectedArtistId, $id);

    }

    public function render()
    {

        // dd($this->id);
        return view('livewire.assign-modal');
    }
}
