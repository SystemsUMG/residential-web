@php($id = $attributes->wire('model')->value)

<div x-data="{ focused: false }" class="position-relative my-3">
    @if($image instanceof  Livewire\TemporaryUploadedFile)
        <x-buttons.danger-button wire:click="$set('{{ $id }}')"
                                 class="position-absolute pb-2 ps-2">
            {{ $titleChange }}
        </x-buttons.danger-button>
        <img src="{{ $image->temporaryUrl() }}" width="50%" class="border-2 rounded" alt="">
    @elseif($existing)
        <label
            for="{{ $id }}"
            class="position-absolute btn btn-warning pb-2 ps-2 cursor-pointer d-flex align-items-center px-4 py-2"
        >
            {{ $titleChange }}
        </label>
        <img src="{{ Storage::disk($diskSave)->url($existing) }}" width="50%" class="border-2 rounded" alt="">
    @else
        <div
            class="border-2 border-dashed rounded p-4 d-flex align-items-center justify-content-center">
            <label
                for="{{ $id }}"
                class="cursor-pointer btn btn-info btn-sm m-0"
            >
                @isset ($url)
                    <img src="{{ $url }}" width="90%" class="border-2 rounded" alt="">
                @endisset
                {{ $titleSelect }}
            </label>
        </div>
    @endif
    @unless($image)
        <input
            wire:model="{{ $id }}"
            x-on:focus="focused = true"
            x-on:blur="focused = false"
            id="{{$id}}"
            type="file"
            name="{{ $name }}"
            {{ ($required ?? false) ? 'required' : '' }}
            {{ $attributes->merge(['class' => 'form-control sr-only']) }}
        >
    @endunless
    @error($name)
    @include('components.inputs.partials.error')
    @enderror
</div>
