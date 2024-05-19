<x-modal wire:model="modal"
         title="Archive Confirmation"
         subtitle="You are archive the opportunity {{ $opportunity?->name }}">

    <x-slot:actions>
        <x-button label="Cancel" @click="$wire.modal = false" />
        <x-button label="Confirm" class="btn-primary" wire:click="archive"/>
    </x-slot:actions>
</x-modal>
