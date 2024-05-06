<div>
    <x-header title="Customers" separator progress-indicator />

    <div class="flex items-end justify-between mb-4">
        <div class="flex items-end w-full space-x-4">
            {{-- Search --}}
            <div class="w-1/3">
                <x-input label="Search by name or email" icon="o-magnifying-glass" wire:model.live="search"
                    placeholder="Search customers..." />
            </div>
            {{-- Archived Customers --}}
            <x-checkbox label="Show archived" wire:model.live="searchTrash" right />
            {{-- Per Page --}}
            <x-select wire:model.live="perPage" :options="[
                ['id' => 5, 'name' => 5],
                ['id' => 15, 'name' => 15],
                ['id' => 25, 'name' => 25],
                ['id' => 50, 'name' => 50],
            ]" label="Records Per Page" />
        </div>

        <div class="flex space-x-4">
            <x-button label="Create Customer" @click="$dispatch('customer::create')" class="btn-dark" icon="o-plus" />
        </div>
    </div>

    <x-table :headers="$this->headers" :rows="$this->items" class="mb-4">
        @scope('header_id', $header)
            <x-table.th :$header name="id" />
        @endscope

        @scope('header_name', $header)
            <x-table.th :$header name="name" />
        @endscope

        @scope('header_email', $header)
            <x-table.th :$header name="email" />
        @endscope

        @scope('actions', $customer)
            <div class="flex items-center justify-center gap-2">
                <x-button
                    id="archive-btn-{{ $customer->id }}"
                    wire:key="archive-btn-{{ $customer->id }}"
                    class="btn-sm"
                    icon="o-trash"
                    @click="$dispatch('customer::archive', { id: {{ $customer->id }} })"
                    spinner
                />

                <x-button
                    icon="o-arrow-path-rounded-square"
                    wire:click="restore({{ $customer->id }})"
                    spinner
                    class="btn-sm btn-success btn-ghost"
                />
            </div>
        @endscope
    </x-table>

    {{ $this->items->links(data: ['scrollTo' => false]) }}

    <livewire:customers.create />
    <livewire:customers.archive />
</div>
