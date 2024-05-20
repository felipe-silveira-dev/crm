<?php

namespace App\Livewire\Opportunities;

use App\Models\Opportunity;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;

/**
 * @property-read Collection|Opportunity[] $opportunities
 */
class Board extends Component
{
    public function render(): View
    {
        return view('livewire.opportunities.board');
    }

    #[Computed]
    public function opportunities(): Collection
    {
        return Opportunity::query()
            // ->orderByRaw("
            //         case
            //             when status = 'open' then 1
            //             when status = 'won' then 2
            //             when status = 'lost' then 3
            //         end
            //     ")
            ->orderByRaw("field(status, 'open', 'won', 'lost')")
            ->orderBy('sort_order')
            ->get();
    }

    #[Computed]
    public function opens(): Collection
    {
        return $this->opportunities->where('status', 'open');
    }

    #[Computed]
    public function wons(): Collection
    {
        return $this->opportunities->where('status', 'won');
    }

    #[Computed]
    public function losts(): Collection
    {
        return $this->opportunities->where('status', 'lost');
    }

    public function updateOpportunities(array $data)
    {
        $order = collect();

        foreach($data as $group) {
            $order->push(
                collect($group['items'])
                    ->map(fn ($i) => $i['value'])
                    ->join(',')
            );
        }

        $open      = explode(',', $order[0]);
        $won       = explode(',', $order[1]);
        $lost      = explode(',', $order[2]);
        $sortOrder = $order->filter(fn ($f) => filled($f))->join(',');

        if(filled($order[0])) {
            DB::table('opportunities')->whereIn('id', $open)->update(['status' => 'open']);
        }

        if(filled($order[1])) {
            DB::table('opportunities')->whereIn('id', $won)->update(['status' => 'won']);
        }

        if(filled($order[2])) {
            DB::table('opportunities')->whereIn('id', $lost)->update(['status' => 'lost']);
        }
        DB::table('opportunities')->update(['sort_order' => DB::raw("field(id, $sortOrder)")]);
    }
}
