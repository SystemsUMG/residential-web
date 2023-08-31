<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-10">
                <h3 class="fw-semibold mb-4 text-dark-emphasis">Usuarios</h3>
            </div>
            <div class="col">
                <button class="btn btn-primary d-flex align-items-center" wire:click="createPenalty">
                    <i class="ti ti-circle-plus fs-6 me-2"></i>
                    Nuevo Usuario
                </button>
            </div>
        </div>
        <livewire:users.users-table/>
    </div>

    <x-modal wire:model="showingModal">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h5 class="modal-title">{!! $modalTitle !!}</h5>
                <button
                    type="button"
                    class="btn"
                    wire:click="$toggle('showingModal')"
                >
                    <i class="ti ti-x fs-6"></i>
                </button>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="save">
                    <div class="row">
                        <x-inputs.text
                            label="Nombre"
                            name="user.name"
                            wire:model="user.name"
                        />
                        <x-inputs.text
                            label="Apellido"
                            name="user.surname"
                            wire:model="user.surname"
                        />
                        <x-inputs.text
                            label="Correo Electrónico"
                            name="user.email"
                            wire:model="user.email"
                        />
                        <x-inputs.text
                            label="Teléfono"
                            name="user.phone"
                            wire:model="user.phone"
                        />
                        <x-inputs.password
                            label="Contraseña"
                            name="password"
                            wire:model="password"
                        />
                        <x-inputs.select
                            label="Rol"
                            name="user.role"
                            wire:model="user.role">
                            <option value="">Seleccionar rol</option>
                            <option value="{{ \App\Enums\UserType::Admin }}">Administrador</option>
                            <option value="{{ \App\Enums\UserType::Residente }}">Residente</option>
                            <option value="{{ \App\Enums\UserType::Operador }}">Operador</option>
                            <option value="{{ \App\Enums\UserType::Guardia }}">Guardia</option>
                        </x-inputs.select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Guardar
                        </button>
                        <button
                            type="button"
                            class="btn btn-danger"
                            wire:click="$toggle('showingModal')"
                        >
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-modal>
</div>
