<div>
    {{-- Success is as dangerous as failure. --}}
    @if($mode == "Artist")
    <form wire:submit.prevent="assign({{$id}})">
        <div class="p-6 rounded-md bg-white">
            <div class="text-black w-full">
                <div>
                    <h1 class="text-2xl mb-4 font-bold">Assign Artist</h1>
                </div>
                @php $artists = App\Models\Employee::where('department_id', "=", '1')->get();
                @endphp
                <select wire:model="selectedArtistId" class="w-full rounded-md focus:border-teal-400 focus:ring-teal-400 mb-4" name="artist">
                    <option value="" selected>Select Artist</option>
                    @foreach ($artists as $artist)
                    <option value="{{$artist->employee_id}}">{{$artist->first_name}}</option>
                    @endforeach
                </select>
            </div>

           <x-primary-button>Assign</x-primary-button>
        </div>
    </form>
    @endif

    @if($mode == "Proceed")
    <form wire:submit.prevent="proceed({{$id}})">
        <div class="p-6 rounded-md bg-white">
            <div class="text-black w-full">
                <div>
                    <h1 class="text-2xl mb-4 font-bold">Assign Printer</h1>
                </div>
                @php $printers = App\Models\Equipment::where('equipment_type', "=", 'Printer')->get();
                @endphp
                <select wire:model="selectedPrinterId" class="w-full rounded-md focus:border-teal-400 focus:ring-teal-400 mb-4" name="artist">
                    <option value="" selected>Select Printer</option>
                    @foreach ($printers as $printer)
                    <option value="{{$printer->id}}">{{$printer->equipment_name}}</option>
                    @endforeach
                </select>
            </div>

           <x-primary-button>Assign</x-primary-button>
        </div>
    </form>
    @endif
</div>
