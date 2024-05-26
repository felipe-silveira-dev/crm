<x-drawer wire:model="modal" title="{{__('Update Customer')}}" class="w-1/3 p-4" right>
    <x-card>
        <x-form wire:submit="save" id="update-customer-form">
            <hr class="my-5" />
            <div class="space-y-2">
                <x-input label="{{__('Name')}}" wire:model="form.name" />
                <x-input label="{{__('Email')}}" wire:model="form.email" />
                <x-input label="{{__('Phone')}}" wire:model="form.phone" />
            </div>
            <x-slot:actions>
                <x-button label="{{__('Cancel')}}" @click="$wire.modal = false" />
                <x-button label="{{__('Save')}}" type="submit" form="update-customer-form" />
            </x-slot:actions>
        </x-form>
    </x-card>

</x-drawer>
