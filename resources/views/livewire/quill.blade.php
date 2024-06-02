<div wire:ignore class="bg-white text-black h-full">
    <style>
        .ql-editor .ql-blank {
            background: #fff;
        }
        .ql-container .ql-snow {}
        #{{ $quillId }} {
            height: 100%;
            border: none;
        }
        .ql-toolbar {
        }
        .ql-blank {}
    </style>
    <!-- Snow Theme stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <!-- Quill library -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <!-- Toolbar container -->
    <div id="toolbar-container">
        <span class="ql-formats">
          <select class="ql-font"></select>
          <select class="ql-size"></select>
        </span>
        <span class="ql-formats">
          <button class="ql-bold"></button>
          <button class="ql-italic"></button>
          <button class="ql-underline"></button>
          <button class="ql-strike"></button>
        </span>
        <span class="ql-formats">
          <select class="ql-color"></select>
          <select class="ql-background"></select>
        </span>
        <span class="ql-formats">
          <button class="ql-script" value="sub"></button>
          <button class="ql-script" value="super"></button>
        </span>
        <span class="ql-formats">
          <button class="ql-header" value="1"></button>
          <button class="ql-header" value="2"></button>
          <button class="ql-blockquote"></button>
          <button class="ql-code-block"></button>
        </span>
        <span class="ql-formats">
          <button class="ql-list" value="ordered"></button>
          <button class="ql-list" value="bullet"></button>
          <button class="ql-indent" value="-1"></button>
          <button class="ql-indent" value="+1"></button>
        </span>
        <span class="ql-formats">
          <button class="ql-direction" value="rtl"></button>
          <select class="ql-align"></select>
        </span>
        <span class="ql-formats">
          <button class="ql-link"></button>
          <button class="ql-image"></button>
          <button class="ql-video"></button>
          <button class="ql-formula"></button>
        </span>
        <span class="ql-formats">
          <button class="ql-clean"></button>
        </span>
    </div>
    <!-- Editor container -->
    <div id="{{ $quillId }}">
        {!! $value !!}
    </div>



    <!-- Initialize Quill editor -->
    <script>
        const quill = new Quill('#{{ $quillId }}', {
            modules: {
                syntax: true,
                toolbar: '#toolbar-container',
            },
            theme: 'snow',
            placeholder: "{{__('Compose an epic...')}}",
        });

        quill.on('text-change', function() {
            @this.set('value', quill.root.innerHTML);
        });

    </script>

</div>
