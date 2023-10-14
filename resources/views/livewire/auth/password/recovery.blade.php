<x-card title="Password Recovery" shadow class="mx-auto w-[450px]">

    @if ($message)
        <x-alert icon="o-exclamation-triangle" class="mb-4 alert-success">
            <span>We have e-mailed your password reset link!</span>
        </x-alert>
    @endif

    <x-form wire:submit="recoverPassword">
        <x-input label="Email" wire:model="email" />
        <x-slot:actions>
            <div class="flex items-center justify-between w-full">
                <a wire:navigate href="{{ route('login') }}" class="link link-primary">
                    I remember my password
                </a>
                <div>
                    <x-button label="Submit" class="btn-primary" type="submit" spinner="submit" />
                </div>
            </div>
        </x-slot:actions>
    </x-form>
</x-card>
