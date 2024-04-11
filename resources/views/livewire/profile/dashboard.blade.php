<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public $products;
    public string $name = '';
    public string $email = '';

    /**
     * Mount the component.
     */
    public function mount($products): void
    {
        $this->products = $products;
        $this->name = Auth::guard('employee')->user()->first_name;
        $this->email =  Auth::guard('employee')->user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::guard('employee')->user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: RouteServiceProvider::HOME);

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section>
<h1 class="text-2xl font-bold mb-4">Hello!</h1>
<div class="columns-3">
    <x-card class="p-4">
        <p>Teams</p>
        <p class="text-2xl font-bold">10</p>
    </x-card>
    <x-card class="p-4">
        <p>Teams</p>
        <p class="text-2xl font-bold">10</p>
    </x-card>
    <x-card class="p-4">
        <p>Teams</p>
        <p class="text-2xl font-bold">10</p>
    </x-card>


</div>
@foreach ($products as $product)
{{$product->team_name}}
@endforeach
</section>
