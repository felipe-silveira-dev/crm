@props(['entangle', 'allowFileUploads' => false])

@push('head')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
@endpush

<div
    wire:ignore
    x-data="{ value: @entangle($entangle) }"
    x-init="$refs.trix.editor.loadHTML(value)"
    x-id="['trix']"
    @trix-change="value = $refs.input.value"
    @if (!$allowFileUploads) @trix-file-accept.prevent @endif
    class="w-full p-2 bg-white text-black shadow-sm border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
>
    <input x-ref="input" type="hidden" :id="$id('trix')">

    <trix-editor x-ref="trix" :input="$id('trix')" class="prose h-96 trix-content text-black"
    ></trix-editor>
</div>

@if (!$allowFileUploads)
    <style>
        [data-trix-button-group="file-tools"] {
            display: none !important;
        }
    </style>
@else
    <script>
        addEventListener("trix-attachment-add", async function(event) {
            const formData = new FormData();
            formData.append("attachment", event.attachment.file);

            const setProgress = (progress) => {
                event.attachment.setUploadProgress(progress);
            };

            const setAttributes = (attributes) => {
                event.attachment.setAttributes(attributes);
            };

            let response = await axios.post(
                '{{ route('trix-file-upload') }}',
                formData, {
                    onUploadProgress: function(progressEvent) {
                        const progress = (progressEvent.loaded / progressEvent.total) * 100;
                        setProgress(progress);
                    },
                },
            );

            setAttributes(response.data);
        });
    </script>
@endif
