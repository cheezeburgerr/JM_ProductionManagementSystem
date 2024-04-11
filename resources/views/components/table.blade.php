

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white ">
            Teams
        </caption>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
            @foreach ($columns as $column)
                <th scope="col" class="px-6 py-3">
                    {{$header}}
                </th>
            @endforeach

        </thead>
        <tbody>
            {{$slot}}
        </tbody>
    </table>


</div>
