    <x-employee-layout>

        <h1 class="text-2xl font-bold mb-4">Hello {{Auth::guard('employee')->user()->first_name}}!</h1>
        @php
        $mode = '';
            $user = Auth::guard('employee')->user();

            switch($user->department_id){
                case '1':
                    $mode = 'artist-dashboard';
                    break;
                case '2':
                    $mode = 'csr-dashboard';
                    break;
                case '4':
                    $mode = 'printer-dashboard';
                    break;
                default:
                    $mode = 'artist-dashboard';
                    break;
            }
// /dd($mode);
        @endphp
       <livewire:info-boxes :employee="$user->employee_id" :mode="$mode"/>

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


        <livewire:data-table :table-name="'Teams'" :columns="$columns"/>



    </x-employee-layout>

