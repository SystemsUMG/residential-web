<div class="container row gap-3 justify-content-center">
    <div class="card col-sm-3">
        <p class="fs-6 fw-bold text-primary">Información</p>
        <div class="card-body">
            <form wire:submit.prevent="saveProfile">
                <x-inputs.text
                    name="name"
                    label="Nombre"
                    wire:model="user.name"
                />
                <x-inputs.text
                    name="name"
                    label="Apellido"
                    wire:model="user.surname"
                />
                <x-inputs.email
                    name="name"
                    label="Correo electrónico"
                    wire:model="user.email"
                />
                <x-inputs.text
                    name="name"
                    label="Teléfono"
                    wire:model="user.phone"
                />
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card col-sm-4">
        <p class="fs-6 fw-bold text-primary">Cambio de contraseña</p>
        <div class="card-body">
            <form wire:submit.prevent="savePassword">
                <x-inputs.password
                    name="currentPassword"
                    label="Contraseña actual"
                    wire:model="currentPassword"
                />
                <x-inputs.password
                    name="newPassword"
                    label="Contraseña nueva"
                    wire:model="newPassword"
                />
                <x-inputs.password
                    name="newPassword_confirmation"
                    label="Confirmar contraseña nueva"
                    wire:model="newPassword_confirmation"
                />
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>