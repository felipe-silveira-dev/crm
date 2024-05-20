<div class=" p-2 grid grid-cols-3 gap-4 h-full" wire:sortable-group="updateOpportunities">
    @foreach ($this->opportunities->groupBy('status') as $status => $items)
        <div wire:key="group-{{ $status }}" class="bg-base-200 p-2">
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
    @endforeach
</div>
