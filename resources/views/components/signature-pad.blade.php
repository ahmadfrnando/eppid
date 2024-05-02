<div x-data="signaturePad(@entangle($attributes->wire('model')))">
    <div class="flex flex-wrap gap-4">
        <canvas x-ref="signature_canvas" class="border rounded shadow max-w-full max-h-full">

        </canvas>
        <x-danger-button class="h-10" x-on:click.prevent="clear()">{{ __('Hapus') }}</x-danger-button>
    </div>
</div>
