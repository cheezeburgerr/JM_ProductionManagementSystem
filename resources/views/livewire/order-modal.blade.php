<div>
    <!-- Livewire Modal -->

    <div x-data="{ showModal: @entangle('showModal') }">
        @if($order)
        <div x-show="showModal" x-on:close.stop="showModal = false"  class="fixed inset-0 z-50 flex items-center justify-center overflow-x-auto overflow-y-auto outline-none focus:outline-none">
            <!-- Modal content -->
            <div class="w-5/6 relative bg-white shadow-lg rounded-md text-left overflow-hidden">
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
                    <div class="flex justify-end mb-4">
                        <button x-on:click="showModal = false" class="text-gray-500 hover:text-gray-600 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
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
                            <x-primary-button>Button</x-primary-button>

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
                  <div>
                    <livewire:lineup-table :id="$order['order_id']" />
                  </div>
                </div>
            </div>
        </div>
        <!-- Backdrop -->
        <div x-show="showModal" x-on:click="showModal = false" class="fixed inset-0 z-40 bg-black opacity-50"></div>
    </div>
@endif

</div>
