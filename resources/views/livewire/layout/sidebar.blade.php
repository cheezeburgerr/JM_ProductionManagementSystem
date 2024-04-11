
<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/home', navigate: true);
    }
}; ?>

<div class="flex">


    <!-- Sidebar -->
    <aside id="drawer-sidebar" class="sticky top-0 z-50 bg-neutral-950 text-white w-64 h-screen px-6 py-4 transition duration-300 transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <h1 class="text-2xl font-bold mb-4">JM Sportswear</h1>
        <ul class="space-y-2">
            <li><a href="{{route('employee.dashboard')}}" class="text-gray-300 hover:text-white" wire:navigate>Dashboard</a></li>
            <li><a href="{{route('teams.index')}}" class="text-gray-300 hover:text-white" wire:navigate>Teams</a></li>
            @if(Auth::guard('employee')->user()->department_id == '2')
            <li><a href="{{route('employee.pending-teams')}}" class="text-gray-300 hover:text-white" wire:navigate>Pending Teams</a></li>
            @endif
            @if(Auth::guard('employee')->user()->department_id == '1')
            <li><a href="{{route('employee.production')}}" class="text-gray-300 hover:text-white">Production</a></li>
            @endif
            {{-- @if(Auth::guard('employee')->user()->department_id == '1' && Auth::guard('employee')->user()->is_supervisor)
            <li><a href="pending-teams" class="text-gray-300 hover:text-white" wire:navigate>Teams Without Artist</a></li>
            @endif --}}


            {{-- <li><a href="#" class="text-gray-300 hover:text-white">Orders</a></li> --}}
        </ul>
    </aside>

    <!-- Main content -->
    <main class="sm:w-full w-full absolute sm:relative left-0">

    <nav class="bg-gray-100 z-20 sticky top-0 p-4 flex flex-row-reverse">
        <div class="flex flex-wrap items-center">
            <button id="drawer-toggle" class="sm:hidden"><svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75z" />
            </svg></button>
            <button><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
              </svg>
              </button>
              {{-- <p class="mx-4"><span>{{Auth::guard('employee')->user()->first_name}}</span></p> --}}
              <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-400 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div x-data="{{ json_encode(['name' => Auth::guard('employee')->user()->first_name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button class="w-full text-start">
                            <x-dropdown-link :href="route('employee.logout')" wire:navigate>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>
              {{-- <x-link :href="route('employee.logout')" wire:navigate>{{ __('Log out') }}</x-link> --}}

        </div>
    </nav>

    <div class="p-4 md:p-8">

<!-- Drawer toggle button -->


<!-- Drawer script -->
<script>
    const drawerToggle = document.querySelector('#drawer-toggle');
    const drawerSidebar = document.querySelector('#drawer-sidebar');

    drawerToggle.addEventListener('click', () => {
        drawerSidebar.classList.toggle('-translate-x-full');
        drawerSidebar.classList.toggle('translate-x-0');});

</script>



