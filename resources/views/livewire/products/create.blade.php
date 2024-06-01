{{-- <x-drawer
 wire:model="createModal" title="{{__('Create Product')}}" class="w-6/12" right with-close-button> --}}
    <x-form wire:submit="save" id="create-product-form">
        <div class="space-y-2">

            <x-choices
                label="{{__('Category')}}"
                wire:model="form.category_id"
                :options="$this->form->categories"
                option-label="title"
                single
                searchable
            />

            <x-input label="{{__('Title')}}" wire:model="form.title" />
            <x-input label="{{__('Code')}}" wire:model="form.code" />
            
            <div class="flex flex-col gap-2">
                <label for="description" class="block ml-2 text-sm font-bold">{{__('Description')}}</label>
                <livewire:editorJS
                    wire:model="form.description"
                    editorId="description"
                    placeholder="{{__('Description')}}"
                    class=""
                    uploadDisk="public"
                    imagePath="products"
                    label="{{__('Description')}}"
                />
            </div>

            <x-input
                label="{{__('Amount')}}"
                wire:model="form.amount"
                prefix="R$"
                locale="pt-BR"
                money
            />
        </div>
        <x-slot:actions>
            <x-button label="{{__('Cancel')}}" @click="$wire.createModal = false" />
            <x-button label="{{__('Save')}}" type="submit" form="create-product-form" />
        </x-slot:actions>
    </x-form>
{{-- </x-drawer> --}}