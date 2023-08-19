@props([
    'name',
    'label',
])

<div class="form-floating mb-3">
    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        rows="3"
        {{ ($required ?? false) ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'form-control text-dark-emphasis']) }}
        placeholder=""
    >{{$slot}}</textarea>
    @if($label ?? null)
        @include('components.inputs.partials.label')
    @endif
</div>

@error($name)
@include('components.inputs.partials.error')
@enderror
