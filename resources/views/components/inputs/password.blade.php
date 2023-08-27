@props([
    'name',
    'label',
    'value',
    'min' => null,
    'max' => null,
    'step' => null,
])

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
        <i class="ti ti-eye-off fs-6" id="togglePassword"></i>
    </div>
</div>
@error($name)
@include('components.inputs.partials.error')
@enderror
@push('scripts')
    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#{{ $name }}");
        togglePassword.addEventListener("click", function () {
            if (password.getAttribute("type") === "password") {
                password.setAttribute("type", "text");
                this.classList.remove("ti-eye-off");
                this.classList.toggle("ti-eye");
            } else {
                password.setAttribute("type", "password");
                this.classList.remove("ti-eye");
                this.classList.toggle("ti-eye-off");
            }
        });
    </script>
@endpush
