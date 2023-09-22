@props([
    'name',
    'label',
    'value',
    'min' => null,
    'max' => null,
    'step' => null,
])
@php
    $name = str_replace('.', '_', $name);
@endphp

<div class="input-group mb-3">
    <div class="form-floating">
        <input
            type="password"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ old($name, $value ?? '') }}"
            {{ ($required ?? false) ? 'required' : '' }}
            {{ $attributes->merge(['class' => 'form-control']) }}
            {{ $min ? "min={$min}" : '' }}
            {{ $max ? "max={$max}" : '' }}
            {{ $step ? "step={$step}" : '' }}
            placeholder=""
        >
        @if($label ?? null)
            @include('components.inputs.partials.label')
        @endif
    </div>
    <div class="input-group-text">
        <i class="ti ti-eye-off fs-6" id="togglePassword-{{ $name }}"></i>
    </div>
</div>
@error($name)
@include('components.inputs.partials.error')
@enderror
@push('scripts')
    <script>
        const togglePassword{{ $name }} = document.querySelector("#togglePassword-{{ $name }}");
        const password{{ $name }} = document.querySelector("#{{ $name }}");
        togglePassword{{ $name }}.addEventListener("click", function () {
            if (password{{ $name }}.getAttribute("type") === "password") {
                password{{ $name }}.setAttribute("type", "text");
                this.classList.remove("ti-eye-off");
                this.classList.toggle("ti-eye");
            } else {
                password{{ $name }}.setAttribute("type", "password");
                this.classList.remove("ti-eye");
                this.classList.toggle("ti-eye-off");
            }
        });
    </script>
@endpush
