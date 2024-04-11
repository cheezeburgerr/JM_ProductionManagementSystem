<!-- resources/views/livewire/data-table.blade.php -->

<div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">

    <input wire:model.debounce.300ms="search" type="text" placeholder="Search...">
    <table id="table" class="w-full text-sm text-left rtl:text-right text-gray-500">
        <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900">
            Teams

        </caption>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
            <tr>
                @foreach($columns as $column)
                    <th>
                        <a href="" class="px-6 py-3" scope="col" wire:click.prevent="sortBy('{{ $column['field'] }}')">{{ $column['title'] }}</a>
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
            @foreach($items as $item)
                <tr class="bg-white border-b">
                    @foreach($columns as $column)
                        <td class="px-6 py-4">{{ $item->{$column['field']} }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- {{ $items->links() }} --}}
</div>
