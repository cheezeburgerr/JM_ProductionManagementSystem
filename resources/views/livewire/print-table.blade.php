<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <x-card class="p-4 mb-4">
        <div class="columns-2">
            <div class="break-inside-avoid-column">
                <div>
                    <p>Team: <span class="font-bold">{{ $order->team_name }}</span></p>
                    <p>Apparel: <span class="font-bold">{{ $order->apparel }}</span></p>
                    <p>Due Date: <span
                            class="font-bold">{{ \Carbon\Carbon::parse($order->due_date)->format('M d, Y') }}</span></p>
                </div>
            </div>
            <div class="break-inside-avoid-column">
              <div class="float-right">
                <x-primary-button class="{{ $status === 'Printing' ? 'bg-red-500 hover:bg-red-600' : '' }}" wire:click="togglePrinting()">
                    {{ $status === 'Printing' ? 'Stop Printing' : 'Start Printing' }}
                </x-primary-button>
                <x-primary-button  x-on:click.prevent="$dispatch('open-modal', 'return-modal')" :disabled="$status == 'Printing' ? true : false ">
                    Finish
                </x-primary-button>

                <x-modal name="return-modal" maxWidth="5xl">
                    @php $data = $order->order_id @endphp
                    <livewire:return-data :id="$data" />
                </x-modal>


              </div>



                <div class="my-12" x-data="{ width: '{{$progress}}' }" x-init="$watch('width', value => { if (value > 100) { width = 100 } if (value == 0) { width = 10 } })">

                    <!-- Light mode -->
                    <div class="p-4">
                        <!-- Start Light version -->

                        <!-- Start Regular with text version -->
                        <div class="bg-gray-200 h-4 mt-5 rounded-full" role="progressbar" :aria-valuenow="width"
                            aria-valuemin="0" aria-valuemax="100">
                            <div class="bg-teal-400 rounded-full h-4 text-center text-white text-sm transition"
                                :style="`width: {{ $progress }}%; transition: width 2s;`" x-text="`{{ $progress }}%`">
                            </div>
                        </div>
                        <!-- End Regular with text version -->
                    </div>

                </div>
            </div>
        </div>
    </x-card>

    <x-card>
        <div class="relative overflow-x-auto  sm:rounded-lg">
            <div class="flex justify-between items-center mb-4 p-4 bg-white rounded-md"> <!-- Flex container -->
                <h1 class="text-lg font-semibold text-gray-900">Lineup</h1> <!-- Heading -->
                <x-text-input wire:model.live="search" type="text" placeholder="Search..." class="w-48 md:w-64" />
                <!-- Search input -->
            </div>

            <table id="table" class="w-full text-sm text-left rtl:text-right text-gray-500 bg-gray-50">
                <thead class="text-xs text-gray-700 uppercase bg-white">
                    <tr class="py-4">
                        <th></th>
                        @foreach ($columns as $column)
                            <th class="px-6 py-3 text-xs" scope="col">
                                <a href="#"
                                    wire:click.prevent="sortBy('{{ $column['field'] }}')">{{ $column['title'] }}</a>
                                @if ($sortField === $column['field'])
                                    @if ($sortAsc)
                                        &#8593;
                                    @else
                                        &#8595;
                                    @endif
                                @endif
                            </th>
                        @endforeach

                    </tr>
                </thead>
                <tbody>
                    @if ($items->isEmpty())
                        <tr>
                            <td colspan="{{ count($columns) + 1 }}" class="px-6 py-4 text-center text-gray-500">No teams
                                found</td>
                        </tr>
                    @else
                        @foreach ($items as $item)
                            <tr class="border-b hover:bg-gray-500 hover:text-white" wire:loading.class="opacity-50">
                                <td class="px-6 py-4">
                                    <x-checkbox wire:click="toggleStatus({{$item->id}})" type="checkbox" value="{{ $item->id }}" :checked="$item->status == 'Printed' ? true : false " :disabled="$status != 'Printing' ? true : false"></x-checkbox>
                                </td>
                                @foreach ($columns as $column)
                                    <td class="px-6 py-4">
                                        @if ($column['field'] === 'due_date')
                                            {{ \Carbon\Carbon::parse($item->{$column['field']})->format('M d, Y') }}
                                        @elseif($column['field'] === 'status')
                                            @if ($item->{$column['field']} === 'Pending')
                                                <span
                                                    class="bg-yellow-100 text-yellow-800 text-xs rounded-md font-medium me-2 px-2.5 py-0.5">{{ $item->{$column['field']} }}</span>
                                            @elseif ($item->{$column['field']} === 'Designing')
                                                <span
                                                    class="bg-teal-100 text-teal-800 text-xs rounded-md font-medium me-2 px-2.5 py-0.5">{{ $item->{$column['field']} }}</span>
                                            @elseif ($item->{$column['field']} === 'Printing')
                                                <span
                                                    class="bg-blue-100 text-blue-800 text-xs rounded-md font-medium me-2 px-2.5 py-0.5">{{ $item->{$column['field']} }}</span>
                                            @else
                                                <span
                                                    class="bg-slate-100 text-slate-800 text-xs  rounded-md font-medium me-2 px-2.5 py-0.5">{{ $item->{$column['field']} }}</span>
                                            @endif
                                        @else
                                            {{ $item->{$column['field']} }}
                                        @endif
                                    </td>
                                @endforeach

                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>



            <div class="p-4">
                {{ $items->links() }}
            </div>
        </div>
    </x-card>
    @push('scripts')
    <script>
        // Listen for checkbox clicks
        document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
            checkbox.addEventListener('click', function() {
                updateProgressBar();
            });
        });

        // Function to update progress bar
        function updateProgressBar() {
            var checkedCount = document.querySelectorAll('input[type="checkbox"]:checked').length;
            var totalCount = document.querySelectorAll('input[type="checkbox"]').length;
            var progressPercentage = (checkedCount / totalCount) * 100;
            document.getElementById('progress-bar-fill').style.width = progressPercentage + '%';
        }
    </script>
@endpush
</div>
