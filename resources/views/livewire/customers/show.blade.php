<div>
    <x-header title="{{__('Customer') . ' - ' . $customer->name }}" separator/>

    <div class="grid grid-cols-3 gap-4">
        <div class="bg-base-200 rounded-md p-4 space-y-4">
            <div>
                <x-info.title>{{__("Informações Pessoais")}}</x-info.title>
                <x-info.data title="Nome"> {{ $customer->name }}</x-info.data>
                <x-info.data title="Idade"> {{ $customer->age }}</x-info.data>
                <x-info.data title="Genero"> {{ $customer->gender }}</x-info.data>
            </div>

            <div>
                <x-info.title>{{__("Informações Profissionais")}}</x-info.title>
                <x-info.data title="Empresa">{{ $customer->company }}</x-info.data>
                <x-info.data title="Cargo">{{ $customer->position }}</x-info.data>
            </div>

            <div>
                <x-info.title>{{__("Contato")}}</x-info.title>
                <x-info.data title="Email">{{ $customer->email }}</x-info.data>
                <x-info.data title="Telefone">{{ $customer->phone }}</x-info.data>
                <x-info.data title="Linkedin">{{ $customer->linkedin }}</x-info.data>
                <x-info.data title="Facebook">{{ $customer->facebook }}</x-info.data>
                <x-info.data title="Instagram">{{ $customer->instagram }}</x-info.data>
                <x-info.data title="Twitter">{{ $customer->twitter }}</x-info.data>
            </div>

            <div>
                <x-info.title>{{__("Endereço")}}</x-info.title>
                <x-info.data title="Rua">{{ $customer->address }}</x-info.data>
                <x-info.data title="Cidade">{{ $customer->city }}</x-info.data>
                <x-info.data title="Estado">{{ $customer->state }}</x-info.data>
                <x-info.data title="CEP">{{ $customer->zip }}</x-info.data>
            </div>

            <div>
                <x-info.title>{{__("Cadastro")}}</x-info.title>
                <div>{{ $customer->created_at->diffForHumans() }}</div>
                <x-info.title>{{__("Atualização")}}</x-info.title>
                <div>{{ $customer->updated_at->diffForHumans() }}</div>
            </div>
        </div>
        <div class="col-span-2 bg-base-200 rounded-md p-4 space-y-4">
            <div>


                <div>
                    <div class="sm:hidden">
                      <label for="tabs" class="sr-only">Selecionar Aba</label>
                      <select id="tabs" name="tabs" class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option selected>{{__('Opportunities')}}</option>
                        <option>{{__('Tasks')}}</option>
                        <option>{{__('Notes')}}</option>
                      </select>
                    </div>
                    <div class="hidden sm:block">
                      <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                          <x-tab-link href="{{ route('customers.show', [$customer, 'opportunities']) }}" :active="$tab == 'opportunities' ?? false" wire:navigate>
                            <x-icon name="o-currency-dollar" />
                            <span>{{__('Opportunities')}}</span>
                          </x-tab-link>

                          <x-tab-link href="{{ route('customers.show', [$customer, 'tasks']) }}" :active="$tab == 'tasks' ?? false" wire:navigate>
                            <x-icon name="o-wrench" />
                            <span>{{__('Tasks')}}</span>
                          </x-tab-link>

                          <x-tab-link href="{{ route('customers.show', [$customer, 'notes']) }}" :active="$tab == 'notes' ?? false" wire:navigate>
                            <x-icon name="o-book-open" />
                            <span>{{__('Notes')}}</span>
                          </x-tab-link>
                        </nav>
                      </div>
                    </div>
                </div>
            </div>

            <div>@livewire("customers.$tab.index", ["customer" => $customer])</div>
        </div>
    </div>
</div>
