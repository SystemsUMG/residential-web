@props([
    'id',
    'name',
    'label',
    'value' => false,
    'checked' => false,
])

@php
    $checked = !! $checked
@endphp

<div class="form-check form-switch">

    <input
        type="checkbox"
        id="{{ $id ?? $name }}"
        name="{{ $name }}"
        {{ $checked ? 'checked' : '' }}
        {{ $attributes->merge(['class' => 'form-check-input']) }}
        value="{{ $value }}"
    >

    @if($label ?? null)
        <label class="form-check-label text-dark-emphasis" for="{{ $id ?? $name }}">
            {{ $label }}
        </label>
    @endif
</div>

@error($name)
@include('components.inputs.partials.error')
@enderror
