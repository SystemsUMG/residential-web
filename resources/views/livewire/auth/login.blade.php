<form wire:submit.prevent="login">
    <div class="mb-3">
        <x-inputs.text
            name="email"
            label="Correo Electrónico"
            wire:model.defer="email"
        />
    </div>
    <div class="mb-4">
        <x-inputs.password
            name="password"
            label="Contraseña"
            wire:model.defer="password"
        />

    </div>
    <div class="row mb-4">
        <div class="col-4 col-sm-5">
            <x-inputs.checkbox
                name="remember_me"
                label="Recuérdame"
                wire:model.defer="remember_token"
            />
        </div>
        <div class="col">
            <a class="text-primary fw-bold" href="#">Has olvidado tu contraseña ?</a>
        </div>
    </div>
    <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" wire:click="login" type="submit">
        Iniciar Sesión
    </button>
    <div class="d-flex align-items-center justify-content-center">
        <p class="fs-4 mb-0 fw-bold">¿Eres nuevo?</p>
        <a class="text-primary fw-bold ms-2" href="{{ route('register') }}">Crea una cuenta</a>
    </div>
</form>
