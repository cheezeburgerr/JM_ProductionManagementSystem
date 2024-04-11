<div>
    <!-- resources/views/livewire/data-table.blade.php -->

    <div class="flex justify-between items-center mb-4 p-4 bg-white rounded-md"> <!-- Flex container -->
        <h1 class="text-lg font-semibold text-gray-900">Lineup</h1> <!-- Heading -->
        <x-text-input wire:model.live="search" type="text" placeholder="Search..." class="w-64" /> <!-- Search input -->
    </div>
<div class="relative overflow-x-auto  sm:rounded-lg ">
    <div class="px-4">
        <p>Total: <span>{{$count}}</span></p>
    </div>

    <table id="table" class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase">
            <tr class="py-4">
                @foreach($columns as $column)
                <th class="px-6 py-3 text-xs" scope="col"m>
                    <a href="#" wire:click.prevent="sortBy('{{ $column['field'] }}')" >{{ $column['title'] }}</a>
                    @if($sortField === $column['field'])
                        @if($sortAsc)
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
            @if($items->isEmpty())
            <tr>
                <td colspan="{{ count($columns) + 1 }}" class="px-6 py-4 text-center text-gray-500">No teams found</td>
            </tr>
        @else
            @foreach($items as $item)
                <tr class="border-b hover:bg-gray-500 hover:text-white" wire:loading.class="opacity-50">
                    @foreach($columns as $column)
                        <td class="px-6 py-4">

                                {{ $item->{$column['field']} }}

                        </td>
                    @endforeach

                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    <div class="p-4 bg-white">
        {{ $items->links() }}
    </div>
</div>

</div>
