<?php

namespace App\Livewire;

use App\Models\ProductionDetails;
use Livewire\Component;

class InfoBoxes extends Component
{

    public $employee;
    public $mode = "csr-dashboard";
    public $boxes = [];

    public function mount($employee, $mode){
        $this->employee = $employee;
        $this->mode = $mode;
    }
    public function checkMode(){
        $statusArray = ['Ready to Print', 'Printing', 'Printed'];

        if($this->mode == "artist-dashboard"){


            $box1 = ProductionDetails::where('artist_id', $this->employee)->where('status', '!=', 'Finished')->count();
            $box2 = ProductionDetails::where('artist_id', $this->employee)->where('status', 'Designing')->count();
            $box3 = ProductionDetails::where('artist_id', $this->employee)->whereIn('status', $statusArray)->count();
            $box4 = ProductionDetails::where('artist_id', $this->employee)->where('status', 'Finished')->count();


            $this->boxes = [
                ['title' => 'Teams', 'count' => $box1],
                ['title' => 'Designing', 'count' => $box2],
                ['title' => 'Production', 'count' => $box3],
                ['title' => 'Finished', 'count' => $box4],
            ];

            // dd($this->boxes);
        }
        else if($this->mode == "csr-dashboard"){

            $box1 = ProductionDetails::where('status', '!=', 'Finished')->count();
            $box2 = ProductionDetails::where('status', 'Designing')->count();
            $box3 = ProductionDetails::whereIn('status', $statusArray)->count();
            $box4 = ProductionDetails::where('status', 'Finished')->count();


            $this->boxes = [
                ['title' => 'Teams', 'count' => $box1],
                ['title' => 'Designing', 'count' => $box2],
                ['title' => 'Production', 'count' => $box3],
                ['title' => 'Finished', 'count' => $box4],
            ];


        }
    }
    public function render()
    {

        $this->checkMode();
        return view('livewire.info-boxes');
    }
}
