@props([
    'status',
    'items'
])

<div class="bg-base-200 p-2" wire:key="group-{{ $status }}">
    <x-header
        title="{{ $status }}"
        size="text-xl"
        class="px-2 pb-0 mb-2"
        subtitle="Total {{ $items->count() }} Opportunities"
        separator progress-indcator
    />
    <ul
        wire:sortable-group.item-group="{{ $status }}"
        wire:sortable-group.options="{ animation: 100 }"
        class="space-y-2 px-2"
    >
        @empty($items->count())
            <li wire:key='"opportunity-null' class="h-10 border-dashed border-gray-400 border rounded w-full text-center flex items-center justify-center opacity-40">
                Empty List
            </li>
        @endempty
        @foreach ($items as $item)
            <li
                wire:sortable-group.item="{{ $item->id }}"
                wire:key="item-{{ $item->id }}"
                wire:sortable-group.handle
            >
                <x-card class="bg-base-100 p-2 rounded-md shadow-md cursor-grab">
                    {{ $item->title }}
                </x-card>
            </li>
        @endforeach
    </ul>
</div>
