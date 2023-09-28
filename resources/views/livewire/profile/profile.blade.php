<div class="container row gap-3 justify-content-center">
    <div class="card pt-3 col-12 col-sm-4">
        <p class="h4 fw-bold text-dark-emphasis">Información</p>
        <div class="card-body">
            <form wire:submit.prevent="saveProfile">
                <x-inputs.text
                    name="user.name"
                    label="Nombre"
                    wire:model="user.name"
                />
                <x-inputs.text
                    name="user.surname"
                    label="Apellido"
                    wire:model="user.surname"
                />
                <x-inputs.email
                    name="user.email"
                    label="Correo electrónico"
                    wire:model="user.email"
                />
                <x-inputs.text
                    name="user.phone"
                    label="Teléfono"
                    wire:model="user.phone"
                />
                <x-inputs.filepond
                    wire:model="image"
                    files="{{ json_encode($urlImage) }}"
                    allowImagePreview
                    imagePreviewMaxHeight="200"
                    allowFileTypeValidation
                    acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                    allowFileSizeValidation
                    maxFileSize="4mb"
                />
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card col-12 col-sm-4">
        <p class="h4 pt-3 fw-bold text-dark-emphasis">Cambio de contraseña</p>
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
