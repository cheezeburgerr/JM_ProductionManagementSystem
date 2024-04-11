<x-employee-layout>

    <h1 class="text-2xl font-bold mb-4">Pending Teams</h1>

    @php

        $columns = [
            ['title' => 'Team', 'field' => 'team_name'],
            ['title' => 'Apparel', 'field' => 'apparel'],
            ['title' => 'Due Date', 'field' => 'due_date'],
            ['title' => 'Status', 'field' => 'status'],

            // Add more columns as needed
        ];


@endphp

    <livewire:data-table :columns="$columns" :check-pending="true"/>
    <livewire:order-modal />


</div>
</x-employee-layout>

