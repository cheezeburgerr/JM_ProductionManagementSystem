<div>

    {{-- <p>{{ $products->product_name }}</p> --}}

    <form action="{{ route('order.store') }}" method="POST">
        @csrf
        @method('POST')
        <div class="md:columns-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-12 text-gray-900">
                    <div class="space-y-6">
                        <div>
                            <x-input-label for="team_name" :value="__('Team Name')" />
                            <x-text-input wire:model="team_name" id="team_name" name="team_name" type="text"
                                class="mt-1 block w-full" autocomplete="team_name" />
                        </div>
                        <div>
                            <x-input-label for="address" :value="__('Address')" />
                            <x-text-input wire:model="address" id="address" name="address" type="text"
                                class="mt-1 block w-full" autocomplete="address" />
                        </div>
                        <div>
                            <x-input-label for="contact_number" :value="__('Contact Number')" />
                            <x-text-input wire:model="contact_number" id="contact_number" name="contact_number"
                                type="text" class="mt-1 block w-full" autocomplete="contact_number" />
                        </div>
                        <div>
                            <x-input-label for="due_date" :value="__('Due Date')" />
                            <x-text-input wire:model="due_date" id="due_date" name="due_date" type="date"
                                class="mt-1 block w-full" autocomplete="due_date" />
                        </div>
                        <div>


                            <label class="block mb-2 text-sm font-medium text-gray-900" for="default_size">Design</label>
                            <input class="block w-full mb-5 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none" id="default_size" type="file">


                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-12 text-gray-900">
                    <div class="space-y-6">
                        <div>
                            <x-input-label for="apparel" :value="__('Apparel')" />
                            <x-text-input wire:model="apparel" id="apparel" name="apparel" type="text"
                                class="mt-1 block w-full" autocomplete="apparel" value="{{$products->product_name}}" readonly data-price="{{$products->product_price}}"/>
                        </div>



                        @if ($products->options->contains('pivot.product_option_type', 'Cut') || $products->jersey_cut != null)
                            <div>
                                <x-input-label for="jersey_type" :value="__('Cut')" class="m-0" />
                                <ul
                                    class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex">
                                    @foreach ($products->options as $option)
                                        @if ($option->pivot->product_option_type == 'Cut')
                                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                                <div class="flex items-center ps-3">
                                                    <x-radio  id="{{ $option->option_name }}" type="radio"
                                                        name="jersey_cut" value="{{ $option->option_name }}"
                                                        onchange="calculatePrice()" data-price="{{ $option->option_price }}"
                                                        required />
                                                    <label for="{{ $option->option_name }}"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900">{{ $option->option_name }}</label>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if ($products->options->contains('pivot.product_option_type', 'Neck'))
                            <div>
                                <x-input-label for="neck_type" :value="__('Neck')" class="m-0" />
                                <ul
                                    class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex">
                                    @foreach ($products->options as $option)
                                        @if ($option->pivot->product_option_type == 'Neck')
                                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                                <div class="flex items-center ps-3">
                                                    <x-radio  id="{{ $option->option_name }}" type="radio"
                                                        name="neck_type" value="{{ $option->option_name }}"
                                                        onchange="calculatePrice()" data-price="{{ $option->option_price }}"
                                                        required />
                                                    <label for="{{ $option->option_name }}"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900">{{ $option->option_name }}</label>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if ($products->options->contains('pivot.product_option_type', 'Short'))
                            <div>
                                <x-input-label for="short" :value="__('Short')" class="m-0" />
                                <ul
                                    class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex">
                                    @foreach ($products->options as $option)
                                        @if ($option->pivot->product_option_type == 'Short')
                                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                                <div class="flex items-center ps-3">
                                                    <x-radio  id="{{ $option->option_name }}" type="radio"
                                                        name="short_type" value="{{ $option->option_name }}"
                                                        onchange="calculatePrice()" data-price="{{ $option->option_price }}"
                                                        required />
                                                    <label for="{{ $option->option_name }}"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900">{{ $option->option_name }}</label>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if ($products->options->contains('pivot.product_option_type', 'Polo Type'))
                            <div>
                                <x-input-label for="polo" :value="__('Polo')" class="m-0" />
                                <ul
                                    class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex">
                                    @foreach ($products->options as $option)
                                        @if ($option->pivot->product_option_type == 'Polo Type')
                                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                                <div class="flex items-center ps-3">
                                                    <x-radio  id="{{ $option->option_name }}" type="radio"
                                                        name="polo_type" value="{{ $option->option_name }}"
                                                        onchange="calculatePrice()" data-price="{{ $option->option_price }}"
                                                        required />
                                                    <label for="{{ $option->option_name }}"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900">{{ $option->option_name }}</label>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if ($products->options->contains('pivot.product_option_type', 'Collar'))
                            <div>
                                <x-input-label for="collar" :value="__('Collar')" class="m-0" />
                                <ul
                                    class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex">
                                    @foreach ($products->options as $option)
                                        @if ($option->pivot->product_option_type == 'Collar')
                                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                                <div class="flex items-center ps-3">
                                                    <x-radio  id="{{ $option->option_name }}" type="radio"
                                                        name="polo_collar" value="{{ $option->option_name }}"
                                                        onchange="calculatePrice()" data-price="{{ $option->option_price }}"
                                                        required />
                                                    <label for="{{ $option->option_name }}"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900">{{ $option->option_name }}</label>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if ($products->options->contains('pivot.product_option_type', 'Fabric'))
                            <div>
                                <x-input-label for="fabric" :value="__('Fabric')" class="m-0" />
                                <ul
                                    class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex">
                                    @foreach ($products->options as $option)
                                        @if ($option->pivot->product_option_type == 'Fabric')
                                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                                <div class="flex items-center ps-3">
                                                    <x-radio  id="{{ $option->option_name }}" type="radio"
                                                        name="fabric" value="{{ $option->option_name }}"
                                                        onchange="calculatePrice()" data-price="{{ $option->option_price }}"
                                                        required />
                                                    <label for="{{ $option->option_name }}"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900">{{ $option->option_name }}</label>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="flex justify-between">
                            <div class="text-s">Php<span id="totalPrice" class="text-2xl font-bold">{{$products->product_price}}.00 </span>each</div>
                            <x-primary-button>Submit</x-primary-button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </form>

</div>


<script>
    // Function to calculate the total price
    function calculatePrice() {
    var totalPrice = 0;

    // Fetching selected options if available
    var jerseyType = document.querySelector('input[name="jersey_type"]:checked');
    var neckType = document.querySelector('input[name="neck_type"]:checked');
    var shortType = document.querySelector('input[name="short_type"]:checked');
    var poloType = document.querySelector('input[name="polo_type"]:checked');
    var collarType = document.querySelector('input[name="polo_collar"]:checked');
    var fabricType = document.querySelector('input[name="fabric"]:checked');

    // Fetching prices of selected options, if available
    var apparelPrice = parseFloat(document.querySelector('input[name="apparel"]').getAttribute('data-price'));
    var jerseyPrice = jerseyType ? parseFloat(jerseyType.getAttribute('data-price')) : 0;
    var neckPrice = neckType ? parseFloat(neckType.getAttribute('data-price')) : 0;
    var shortPrice = shortType ? parseFloat(shortType.getAttribute('data-price')) : 0;
    var poloPrice = poloType ? parseFloat(poloType.getAttribute('data-price')) : 0;
    var collarPrice = collarType ? parseFloat(collarType.getAttribute('data-price')) : 0;
    var fabricPrice = fabricType ? parseFloat(fabricType.getAttribute('data-price')) : 0;
    // Calculating total price
    totalPrice = apparelPrice + jerseyPrice + neckPrice + shortPrice + poloPrice + collarPrice + fabricPrice;

    // Displaying total price
    document.getElementById('totalPrice').innerText = totalPrice.toFixed(2); // Assuming the price is in decimal format
}

</script>
