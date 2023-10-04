<x-card
    title="Register"
    subtitle="Please fill in your details to register"
    shadow separator
    class="max-w-lg mx-auto border"
>
    <x-form wire:submit="submit">
        <x-input label="Name" wire:model="name" />
        <x-input label="Email" wire:model="email" type="email" />
        <x-input label="Confirm your email" wire:model="email_confirmation" type="email" />
        <x-input label="Password" wire:model="password" type="password" />
        <x-slot:actions>
            <x-button label="Reset" type="reset" />
            <x-button label="Register" class="btn-primary" type="submit" spinner="submit" />
        </x-slot:actions>
    </x-form>
</x-card>
