<div>
    <x-drawer
        wire:model="modal"
        class="w-1/3"
        right
    >
        <x-card title="{{ $user?->name }}" separator>
            @isset($this->user)
                <x-input label="Name" value="{{ $this->user->name }}" readonly class="mb-4" />
                <x-input label="Email" value="{{ $this->user->email }}" readonly class="mb-4" />
                <x-input label="Created At" value="{{ $this->user->created_at->format('d/m/Y H:i:s') }}" readonly class="mb-4" />
                <x-input label="Updated At" value="{{ $this->user->updated_at->format('d/m/Y H:i:s') }}" readonly class="mb-4" />
                <x-input label="Deleted At" value="{{ $this->user->deleted_at?->format('d/m/Y H:i:s') }}" readonly class="mb-4" />
                <x-input label="Deleted By" value="{{ $this->user->deletedBy?->name }}" readonly class="mb-4" />
                <x-input label="Permissions" value="{{ $this->user->permissions->pluck('key')->join(', ') }}" readonly class="mb-4" />
            @endisset
        </x-card>
        <x-card>
            <x-button label="Cancel" @click="$wire.modal = false" class="btn-danger" />
        </x-card>
    </x-drawer>
</div>
