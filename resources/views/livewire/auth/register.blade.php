<x-card title="Register" shadow class="mx-auto w-[450px]">
    <x-form wire:submit="submit">
        <x-input id="name" label="Name" wire:model="name"/>
        <x-input id="email" type="email" label="Email" wire:model="email"/>
        <x-input id="email_confirmation" type="confirmation_email" label="Confirm your email" wire:model="email_confirmation"/>
        <x-input id="password" label="Password" wire:model="password" type="password"/>
        <x-slot:actions>
            <div class="flex items-center justify-between w-full">
                <a wire:navigate href="{{ route('login') }}" class="link link-primary">
                    I already have an account
                </a>
                <div>
                    <x-button label="Reset" type="reset"/>
                    <x-button label="Register" class="btn-primary" type="submit" spinner="submit"/>
                </div>
            </div>
        </x-slot:actions>
    </x-form>
</x-card>
