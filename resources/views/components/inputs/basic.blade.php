@props([
    'name',
    'label',
    'value',
    'type' => 'text',
    'min' => null,
    'max' => null,
    'step' => null,
])


<div class="form-floating mb-3">
    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name, $value ?? '') }}"
        {{ ($required ?? false) ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'form-control text-dark-emphasis']) }}
        {{ $min ? "min={$min}" : '' }}
        {{ $max ? "max={$max}" : '' }}
        {{ $step ? "step={$step}" : '' }}
        placeholder=""
    >
    @if($label ?? null)
        @include('components.inputs.partials.label')
    @endif
</div>

@error($name)
@include('components.inputs.partials.error')
@enderror
