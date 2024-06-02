<div wire:ignore class="bg-white text-black">
    <!-- Snow theme stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />

    <!-- Editor container -->
    <div id="{{ $quillId }}">
        {!! $value !!}
    </div>

    <!-- Quill library -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <!-- Initialize Quill editor -->
    <script>
        const quill = new Quill('#{{ $quillId }}', {
            theme: 'snow'
        });

        quill.on('text-change', function() {
            @this.set('value', quill.root.innerHTML);
        });
    </script>

</div>
