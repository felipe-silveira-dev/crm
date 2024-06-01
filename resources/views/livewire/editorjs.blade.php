<div
    x-data="editorInstance('data', '{{ $editorId }}', {{ $readOnly ? 'true' : 'false' }}, '{{ $placeholder }}', '{{ $logLevel }}')"
    x-init="startEditor()"
    class="{{ $class }}"
    wire:ignore
>
    <style>
        .codex-editor {
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
        } 
        .codex-editor--narrow {} 
        .codex-editor--empty {}

        .codex-editor__redactor {}
    </style>
    <div id="{{ $editorId }}" class="border border-red-500 bg-white pt-2">
    
    
    </div>
</div> 

