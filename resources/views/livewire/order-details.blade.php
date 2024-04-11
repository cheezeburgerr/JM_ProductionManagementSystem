<div wire:key="order{{ uniqid() }}">

    <div class=" relative bg-white shadow-lg rounded-md text-left overflow-hidden text-black">
        <!-- Header -->
        {{-- <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200 bg-gray-100">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Order Details</h3>
            <button x-on:click="showModal = false" class="text-gray-500 hover:text-gray-600 focus:outline-none">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div> --}}
        <!-- Body -->
        <div class="p-4">
            <!-- Add your order details here -->

            <div class="flex justify-between">
                <div>
                    <p class="font-bold">Order ID#{{$order['order_id']}}</p>
                <p class="">{{$order['created_at']}}</p>
                <p class="">Status:
                    @if($order['status'] === 'Pending')
                    <span class="bg-yellow-100 text-yellow-800 text-xs rounded-md font-medium me-2 px-2.5 py-0.5">{{ $order['status'] }}</span>
                    @elseif ($order['status'] === 'Designing')
                    <span class="bg-teal-100 text-teal-800 text-xs rounded-md font-medium me-2 px-2.5 py-0.5">{{ $order['status'] }}</span>
                    @elseif ($order['status'] === 'Printing')
                    <span class="bg-blue-100 text-blue-800 text-xs rounded-md font-medium me-2 px-2.5 py-0.5">{{ $order['status'] }}</span>
                    @else
                    <span class="bg-slate-100 text-slate-800 text-xs  rounded-md font-medium me-2 px-2.5 py-0.5">{{ $order['status'] }}</span>
                    @endif</span></p>
                </div>
                <div class="items-center">

                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-4 py-2 bg-teal-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-700 focus:bg-teal-700 active:bg-teal-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <div x-data="{{ json_encode(['name' => 'Options']) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                @if($order['printer_id'] == null)
                                    <x-dropdown-link x-on:click.prevent="$dispatch('open-modal', 'artist-modal')">
                                        {{ __('Assign to Artist') }}
                                    </x-dropdown-link>

                                <!-- Authentication -->
                                @if($order['artist_id'] !== null)
                                <x-dropdown-link x-on:click.prevent="$dispatch('open-modal', 'proceed-modal')">
                                    {{ __('Proceed') }}
                                    </x-dropdown-link>
                                @endif
                               @endif
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <x-modal  name="artist-modal"  focusable>

                        @php $data = $order['order_id'] @endphp
                       <livewire:assign-modal :id="$data" :mode="'Artist'" wire:key="'assign{{$order->order_id}}'"/>

                    </x-modal>

                    <x-modal  name="proceed-modal"  focusable>

                        @php $data = $order['order_id'] @endphp
                       <livewire:assign-modal :id="$data" :mode="'Proceed'" wire:key="'proceed{{$order->order_id}}'"/>

                    </x-modal>
                </div>
            </div>
          <div class="p-4">
           <div class="columns-2">
                <div class="break-inside-avoid-column mb-4">
                    <h1>Team: <span class="font-bold">{{$order['team_name']}}</span></h1>
                    <p class="">Apparel: <span class="font-bold">{{$order['apparel']}}</span></p>
                    <p class="">Due Date: <span class="font-bold">{{ \Carbon\Carbon::parse($order['due_date'])->format('M d, Y') }}</span></p>

                </div>
                <div class="break-inside-avoid-column mb-4">

                    @if($order['apparel'] == 'Fullset Jersey')
                    <p>Cut: <span class="font-bold">{{$order['jersey_cut']}}</span></p>
                    <p class="">Neck: <span class="font-bold">{{$order['neck_type']}}</span></p>
                    <p class="">Short: <span class="font-bold">{{$order['short_type']}}</span></p>
                    @elseif($order['apparel'] == 'Upper Jersey')
                    <p>Cut: <span class="font-bold">{{$order['jersey_cut']}}</span></p>
                    <p class="">Neck: <span class="font-bold">{{$order['neck_type']}}</span></p>

                    @elseif($order['apparel'] == 'Short')
                    <p class="">Short: <span class="font-bold">{{$order['short_type']}}</span></p>
                    @elseif($order['apparel'] == 'T-Shirt')
                    <p class="">Neck: <span class="font-bold">{{$order['neck_type']}}</span></p>
                    @elseif($order['apparel'] == 'Polo Shirt')
                    <p class="">Type: <span class="font-bold">{{$order['polo_type']}}</span></p>
                    <p class="">Collar: <span class="font-bold">{{$order['polo_collar']}}</span></p>
                    @elseif($order['apparel'] == 'Longsleeve')
                    <p class="">Neck: <span class="font-bold">{{$order['neck_type']}}</span></p>
                    @endif
                    <p class="">Fabric: <span class="font-bold">{{$order['fabric']}}</span></p>
                </div>
                <div class="break-inside-avoid-column mb-4">
                    <p class="">Downpayment:</p>
                    <p class="">Price:</p>
                    <p class="">Total Price:</p>
                </div>

                <div class="break-inside-avoid-column mb-4">
                    <p class="font-bold">Design</p>
                </div>
           </div>
          </div>
          <div wire:key="'div-lineup{{$order->order_id}}'">
            <livewire:lineup-table :id="$order['order_id']" wire:key="'lineup{{$order->order_id}}'" />
          </div>
        </div>
    </div>

</div>
