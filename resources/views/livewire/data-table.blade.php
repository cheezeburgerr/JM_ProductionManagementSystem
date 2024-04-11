<div>
    <!-- resources/views/livewire/data-table.blade.php -->

    <div class="bg-gray-50 rounded-md shadow shadow-gray-200">
        <div class="flex justify-between items-center p-4 bg-white rounded-md"> <!-- Flex container -->
            <h1 class="text-lg font-semibold text-gray-900">{{ $tableName }}</h1> <!-- Heading -->
            <x-text-input wire:model.live="search" type="text" placeholder="Search..." class="w-48 md:w-64" />
            <!-- Search input -->
        </div>
        <div class=" overflow-x-auto  sm:rounded-lg ">


            <table id="table-auto" class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-white">
                    <tr class="py-4">
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
                        <th></th>
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
                        <div wire:key="{{ Str::uuid() }}">
                            <tr class="border-b hover:bg-gray-500 hover:text-white" wire:loading.class="opacity-50" wire:key="{{ Str::uuid() }}">
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
                                        @elseif($column['field'] === 'progress')
                                            <div class="bg-gray-200 h-4 rounded-full" role="progressbar"
                                                :aria-valuenow="width" aria-valuemin="0" aria-valuemax="100">
                                                <div class="bg-teal-400 text-xs rounded-full h-4 text-center text-white text-sm transition"
                                                :style="`width: {{ $item->{$column['field']} }}%; transition: width 2s;`" x-text="`{{ $item->{$column['field']} }}%`">
                                            </div>
                                            </div>
                                        @else
                                            {{ $item->{$column['field']} }}
                                        @endif
                                    </td>
                                @endforeach
                                <td wire:key="{{ Str::uuid() }}">



                                    @if ($checkPending == true)
                                        {{-- <x-link :href="route('employee.approve', ['id' => $item->order_id])" wire:navigate>{{__('Approve')}}</x-link> --}}
                                        <button wire:click="updateStatus({{ $item->order_id }})"
                                            class="p-2 bg-teal-500 rounded-md text-xs text-white uppercase tracking-widest font-semibold">Approve</button>
                                    @endif



                                    <x-primary-button x-data="{open: false}" @click="open = ! open"
                                        x-on:click.prevent="$dispatch('open-modal', 'order-modal({{ $item->order_id }})')">{{ __('View') }}</x-primary-button>

                                        <x-modal name="order-modal({{ $item->order_id }})" maxWidth="5xl" wire:key="{{ Str::uuid() }}">

                                            <div wire:key="{{ Str::uuid() }}">

                                            <livewire:order-details :data="$item->order_id" wire:key="{{ Str::uuid() }}"/>
                                            </div>
                                                {{-- <x-order-detail :order="$item->order_id"></x-order-detail> --}}

                                        </x-modal>

                                        @if(Auth::guard('employee')->user()->department_id == '4' || Auth::guard('employee')->user()->department_id == '1')
                                            <x-primary-button x-data="{open: false}" @click="open = ! open"
                                        x-on:click.prevent="$dispatch('open-modal', 'error-modal({{ $item->order_id }})')">{{ __('Check') }}</x-primary-button>

                                        <x-modal name="error-modal({{ $item->order_id }})" maxWidth="5xl" wire:key="{{ Str::uuid() }}">

                                            <div wire:key="{{ Str::uuid() }}">

                                            <livewire:order-details :data="$item->order_id" wire:key="{{ Str::uuid() }}"/>
                                            </div>
                                                {{-- <x-order-detail :order="$item->order_id"></x-order-detail> --}}

                                        </x-modal>
                                        @endif

                                    @if ($withoutArtist)
                                        {{-- <button wire:click="updateStus({{ $item->order_id }})" class="p-2 bg-teal-500 rounded-md text-xs text-white uppercase tracking-widest font-semibold">Assign</button> --}}
                                        <x-primary-button x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'artist-modal({{$item->order_id}})')">{{ __('Assign') }}</x-primary-button>



                                        <x-modal name="artist-modal({{$item->order_id}})" focusable wire:key="{{ Str::uuid() }}">

                                            @php $data = $item->order_id @endphp
                                        <div wire:key="{{ Str::uuid() }}">
                                            <livewire:assign-modal :id="$data" :mode="'Artist'" wire:key="{{ Str::uuid() }}" />

                                        </div>
                                        </x-modal>
                                    @endif




                                    @if (Auth::guard('employee')->user()->department_id == '4')
                                        <x-link :href="route('employee.print', ['id' => $item->order_id])" wire:navigate>Print</x-link>
                                    @endif
                                </td>
                            </tr>
                        </div>
                        @endforeach
                    @endif
                </tbody>
            </table>




            <div class="p-4 bg-white">
                {{ $items->links() }}
            </div>
        </div>

    </div>


</div>
