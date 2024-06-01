<div
    x-data="editorInstance('data', '{{ $editorId }}', {{ $readOnly ? 'true' : 'false' }}, '{{ $placeholder }}', '{{ $logLevel }}')"
    x-init="startEditor()"
    class="{{ $class }}"
    wire:ignore
>
    <style>
        .codex-editor {
            border: 2px solid red;
            height: 100%;
            min-height: 30vh;
            padding: 0px!important;
            
        }
        .codex-editor--narrow {}
        .codex-editor--empty {}

        .codex-editor__redactor {
            padding-bottom: 0px!important;
        }

        .ce-block {}

        .ce-block__content {}

        .ce-paragraph {}
        .cdx-block {}

        .ce-toolbar {
            top: 0px!important;
        }
        
        .ce-toolbar--opened {
            top: 0px!important;
        }

        .ce-toolbar__content {}

        .toolbar__actions {
            border: 2px solid red;
        }

        .ce-toolbar__plus {
        }

        .ce-toolbar__plus:hover {
        }

        .ce-toolbar__settings-btn {
        }

        .ce-toolbar__settings-btn:hover {
        }

        .ce-toolbox {}

        .ce-popover__overlay 

        .ce-popover__overlay--hidden {}

        .ce-popover {}

        .cdx-search-field {} 

        .ce-popover__search {}

        .cdx-search-field__icon {}

        .cdx-search-field__input {}

        .cdx-search-field__input {}

        .ce-popover__nothing-found-message {}

        .ce-popover__items {}

        .ce-popover-item {}

        .ce-popover-item__icon {}

        .ce-popover-item__title {}
    </style>
    <div id="{{ $editorId }}" class="">


    </div>
</div>

