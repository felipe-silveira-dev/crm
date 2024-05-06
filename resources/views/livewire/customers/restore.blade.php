<x-modal wire:model="modal"
         title="Restore Confirmation"
         subtitle="You are restoring customer {{ $customer?->name }}">

    <x-slot:actions>
        <x-button label="Cancel" @click="$wire.modal = false"/>
        <x-button label="Confirm" class="btn-primary" wire:click="restore"/>
    </x-slot:actions>
</x-modal>
