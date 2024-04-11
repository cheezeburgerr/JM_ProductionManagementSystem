<x-employee-layout>

    <h1 class="text-2xl font-bold mb-4">Teams</h1>


    @php
    if(Auth::guard('employee')->user()->department_id == '1'){
        $columns = [
            ['title' => 'Team', 'field' => 'team_name'],
            ['title' => 'Apparel', 'field' => 'apparel'],
            ['title' => 'Due Date', 'field' => 'due_date'],
            ['title' => 'Status', 'field' => 'status'],

            // Add more columns as needed
        ];
    }
    else if(Auth::guard('employee')->user()->department_id == '2'){
        $columns = [
            ['title' => 'Team', 'field' => 'team_name'],
            ['title' => 'Apparel', 'field' => 'apparel'],
            ['title' => 'Due Date', 'field' => 'due_date'],
            ['title' => 'Status', 'field' => 'status'],
            ['title' => 'Artist', 'field' => 'first_name'],
        ]; // Added semicolon here
    }
    else {
        $columns = [
            ['title' => 'Team', 'field' => 'team_name'],
            ['title' => 'Due Date', 'field' => 'due_date'],
            ['title' => 'Status', 'field' => 'status'],
            ['title' => 'Progress', 'field' => 'progress']
        ];
    }
@endphp

    <livewire:data-table :table-name="'My Teams List'" :columns="$columns"  wire:poll/>

    @if(Auth::guard('employee')->user()->department_id == '1' && Auth::guard('employee')->user()->is_supervisor)
    <div class="mt-4">
        <livewire:data-table :table-name="'Teams Without Artist'" :columns="$columns" :without-artist="true" />
    </div>
    @endif
    <livewire:order-modal />


</div>
</x-employee-layout>

