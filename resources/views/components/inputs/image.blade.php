@props([
    'name',
    'model',
    'multiple' => false,
    'files' => [],
])
<div class="row">
    @if(count($files) > 0)
        <div class="row gap-3 justify-content-center">
            @foreach($files as $file)
                <div class="position-relative w-25 p-0">
                    <img class="img-thumbnail" src="{{ Storage::disk('public')->url($file) }}">
                    <span wire:click="removeFile('{{ $file }}')"
                          class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger p-0 cursor-pointer">
                        <i class="ti ti-x"></i>
                    </span>
                </div>
            @endforeach
        </div>
    @endif
    @if($multiple)
        <div class="row gap-3 justify-content-center">
            @forelse($model as $image)
                <div class="position-relative w-25 p-0">
                    <img class="img-thumbnail" src="{{ $image->temporaryUrl() }}">
                    <span
                        x-on:click="@this.removeUpload('{{ $name }}', '{{ $image->getFilename() }}')"
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger p-0 cursor-pointer">
                        <i class="ti ti-x"></i>
                    </span>
                </div>
            @empty
            @endforelse
        </div>
        <div x-data="{ isUploading: false, progress: 0 }"
             x-on:livewire-upload-start="isUploading = true"
             x-on:livewire-upload-finish="isUploading = false"
             x-on:livewire-upload-error="isUploading = false"
             x-on:livewire-upload-progress="progress = $event.detail.progress">

            <div x-show="isUploading" class="progress my-2">
                <div class="progress-bar progress-bar-striped progress-bar-animated"
                     role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                     x-bind:style="`width: ${progress}%`"></div>
            </div>

            <div class="mb-3">
                <label class="text-dark-emphasis mb-2" for="{{ $name }}"></label>
                <input
                    multiple
                    type="file"
                    class="form-control"
                    wire:model="{{ $name }}"
                >
                @error("$name.*")
                @include('components.inputs.partials.error')
                @enderror
            </div>
        </div>
    @else
        <div class="row gap-3 justify-content-center">
            @if($model)
                <div class="position-relative w-25 p-0">
                    <img class="img-thumbnail" src="{{ $model->temporaryUrl() }}">
                    <span
                        x-on:click="@this.removeUpload('{{ $name }}', '{{ $model->getFilename() }}')"
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger p-0 cursor-pointer">
                        <i class="ti ti-x"></i>
                    </span>
                </div>
            @endif
        </div>
        <div x-data="{ isUploading: false, progress: 0 }"
             x-on:livewire-upload-start="isUploading = true"
             x-on:livewire-upload-finish="isUploading = false"
             x-on:livewire-upload-error="isUploading = false"
             x-on:livewire-upload-progress="progress = $event.detail.progress">

            <div x-show="isUploading" class="progress my-2">
                <div class="progress-bar progress-bar-striped progress-bar-animated"
                     role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                     x-bind:style="`width: ${progress}%`"></div>
            </div>

            <div class="mb-3">
                <label class="text-dark-emphasis mb-2" for="{{ $name }}"></label>
                <input
                    type="file"
                    class="form-control"
                    wire:model="{{ $name }}"
                >
                @error("$name")
                @include('components.inputs.partials.error')
                @enderror
            </div>
        </div>
    @endif
</div>
