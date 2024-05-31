<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class Update extends Component
{
    use Toast;

    public Form $form;

    public bool $updateModal = false;

    public function render(): View
    {
        return view('livewire.products.update');
    }

    #[On('product::update')]
    public function load(int $productId): void
    {
        $product = Product::query()->whereId($productId)->firstOrFail();
        $this->form->setProduct($product);
        $this->form->resetErrorBag();
        $this->updateModal = true;
    }

    public function save(): void
    {
        $this->form->update();

        $this->updateModal = false;
        $this->success(__('Updated successfully.'));
        $this->dispatch('product::reload')->to('products.index');
    }

    public function search(string $value = ''): void
    {
        $this->form->searchCategory($value);
    }
}
