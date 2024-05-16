<x-drawer wire:model="modal" title="Update Customer" class="w-1/3 p-4" right>
    <x-card>
        <x-form wire:submit="save" id="update-customer-form">
            <hr class="my-5" />
            <div class="space-y-2">
                <x-input label="Title" wire:model="form.name" />
                <x-select
                label="Status"
                :options="[
                    ['id' => 'open', 'name' =>'open'],
                    ['id' => 'won', 'name' =>'won'],
                    ['id' => 'lost', 'name' =>'lost'],
                ]"
                wire:model="form.status"
            />
            <x-input label="Amount" wire:model="form.amount"
                     prefix="R$" locale="pt-BR" money/>
            </div>
            <x-slot:actions>
                <x-button label="Cancel" @click="$wire.modal = false" />
                <x-button label="Save" type="submit" form="update-customer-form" />
            </x-slot:actions>
        </x-form>
    </x-card>

</x-drawer>
