<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;


new class extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public $image ;
    public $user;
    /**
     * Mount the component.
     */

    protected $listeners = ['refreshProfileComponent'=>'mount'];

     public function mount(): void
    {
        $this->user = Auth::user();
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->image = Auth::user()->image;

    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

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

    public function changePicture()
    {
        $this->validate([
        'image' => 'required',
        ]);
        if($this->image)
        {
           $filePath = $this->image->store('images', 'public');
        }
        $user = User::where('id', auth()->user()->id)->first();
        $user->image = $filePath;
        $user->save();
        $this->dispatch('refreshProfileComponent')->self();
    }
    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $path = session('url.intended', RouteServiceProvider::HOME);

            $this->redirect($path);

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium   dark:text-gray-600">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm  dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>
    <br>

      <div>
        <x-input-label  :value="__('Profile Picture')" />
        <img class="flex h-[200px] w-[200px] w-10 h-10 rounded-full " src="{{ asset('storage/'. $image) }}"> 
        <form wire:submit="changePicture">
            <br>
            <input accept="image/png, image/jpeg, image/jpg" type="file"  wire:model.live="image"  required> <br><br>
            <x-primary-button type="submit">{{ __('Change') }}</x-primary-button>
        </form>
        </div>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">

           
       
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button wire:click.prevent="sendVerification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            <x-action-message class="me-3" on="profile-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
 
</section>
