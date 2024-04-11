<x-employee-layout>

    <h1 class="text-2xl font-bold mb-4">Production</h1>

    <div class="container p-4">
        <div class="lg:columns-2">
            <div class="break-inside-avoid-column">
                <div class="columns-2">
                    <x-card class="p-4 mb-4">
                        <p>Printing</p>
                        <p class="text-2xl font-bold">10</p>
                    </x-card>
                    <x-card class="p-4 mb-4">
                        <p>Printed</p>
                        <p class="text-2xl font-bold">10</p>
                    </x-card>
                    <x-card class="p-4 mb-4">
                        <p>Lineup Errors</p>
                        <p class="text-2xl font-bold">10</p>
                    </x-card>
                    <x-card class="p-4 mb-4">
                        <p>Returned</p>
                        <p class="text-2xl font-bold">10</p>
                    </x-card>
                </div>

            </div>

            <div class="break-inside-avoid-column">
                <x-card class="p-4">
                    <p class="font-semibold uppercase text-s tracking-widest">Chart</p>
                </x-card>
            </div>
        </div>
        <div class="relative break-inside-avoid-column">
            @php
                 $columns = [
            ['title' => 'Team', 'field' => 'team_name'],
            ['title' => 'Due Date', 'field' => 'due_date'],
            ['title' => 'Status', 'field' => 'status'],
            // Add more columns as needed
        ];
            @endphp
            <livewire:data-table :columns="$columns" :production="true"/>
        </div>

    </div>


</x-employee-layout>
