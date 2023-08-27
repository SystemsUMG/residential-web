@props([
    'name',
    'label',
    'type' => 'text',
])

<div class="form-floating mb-3">
    <select
        id="{{ $name }}"
        name="{{ $name }}"
        {{ ($required ?? false) ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'form-control text-dark-emphasis']) }}
        autocomplete="off"
    >{{ $slot }}</select>
    @if($label ?? null)
        @include('components.inputs.partials.label')
    @endif
</div>

@error($name)
@include('components.inputs.partials.error')
@enderror
