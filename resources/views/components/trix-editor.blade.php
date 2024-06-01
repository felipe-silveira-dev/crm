@props([
    'model',
    'field',
    'options' => []
])

@dump($model, $field, $options)
<div class="bg-white rounded-lg shadow-lg p-4 border-primary text-black ">
    <trix-editor>
        <input type="hidden" x-ref="input" x-model="value">
        <trix-editor x-ref="editor" input="input"></trix-editor>
    </trix-editor>
</div>




{{-- @props([
    'label' => 'form.description'
]) --}}

{{-- <textarea wire:model='form.description' name="form.description" id="" cols="30" rows="10"></textarea> --}}

{{-- <label for="{{ $attributes->get('id') }}" class="block text-sm font-bold">{{ __($label) }}</label> --}}
{{-- <div class="bg-white rounded-lg shadow-lg p-4 border-primary text-black ">
    <div class="trix-editor" x-data="{ value: @entangle('form.description').live }" x-init="new Trix.attach($refs.editor, { value: value })">
        <input type="hidden" x-ref="input" x-model="value">
        <trix-editor x-ref="editor" input="input"></trix-editor>
    </div>
</div> --}}

{{-- <script>

    // pega o valor do trix-editor e passa para o input hidden
    document.addEventListener('trix-change', function (event) {
        var input = event.target.editorElement.parentElement.querySelector('input');
        input.value = event.target.value;

        console.log(input.value);
    });
</script> --}}
