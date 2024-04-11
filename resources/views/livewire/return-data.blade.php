<div>
    <form action="{{ route('set.errors') }}" method="POST">
        @csrf
        @method('PUT')
        <x-card>
            <div class="p-4">
                <h1 class="text-2xl font-bold">Unprinted Items</h1>
                <div class="p-4 overflow-x-auto relative">
                    <table id="table" class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-white">
                            <tr class="py-4">
                                <th>Name</th>
                                <th>Details</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unprinted as $data)
                                <tr>
                                    <input type="hidden" name="ids[]" value="{{ $data->id }}">
                                    <td>{{ $data->player_name }}</td>
                                    <td>{{ $data->player_details }}</td>
                                    <td>
                                        <div class="flex items-center">
                                            <div class="flex me-3">
                                                <x-checkbox id="1" class="me-2" name="note[{{ $loop->index }}][]" value="Wrong Size" type="checkbox"></x-checkbox>
                                                <input-label for="1">Wrong Size</input-label>
                                            </div>
                                            <div class="flex me-3">
                                                <x-checkbox id="2" class="me-2" name="note[{{ $loop->index }}][]" value="Wrong Number/Detail" type="checkbox"></x-checkbox>
                                                <input-label for="2">Wrong Number/Detail</input-label>
                                            </div>
                                            <div class="flex me-3">
                                                <x-checkbox id="3" class="me-2" name="note[{{ $loop->index }}][]" value="Reprint" type="checkbox"></x-checkbox>
                                                <input-label for="3">Reprint</input-label>
                                            </div>
                                            <div class="flex me-3">
                                                <x-checkbox id="4" class="me-2" name="note[{{ $loop->index }}][]" value="Other Reason" type="checkbox"></x-checkbox>
                                                <input-label for="4">Other Reason</input-label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </x-card>
        <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
    </form>
</div>
