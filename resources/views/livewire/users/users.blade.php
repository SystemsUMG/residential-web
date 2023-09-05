<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-10">
                <h3 class="fw-semibold mb-4 text-dark-emphasis">Usuarios</h3>
            </div>
            <div class="col">
                @can('create', \App\Models\User::class)
                    <button class="btn btn-primary d-flex align-items-center" wire:click="createUser">
                        <i class="ti ti-circle-plus fs-6 me-2"></i>
                        Nuevo Usuario
                    </button>
                @endcan
            </div>
        </div>
        <livewire:users.users-table/>
    </div>

    <x-modal wire:model="showingModal" maxWidth="{{$formUser ? 'md': 'xl'}}">
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
                @if($formUser)
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
                                name="role"
                                wire:model="role">
                                <option value="">Seleccionar rol</option>
                                @foreach(\Spatie\Permission\Models\Role::get() as $role)
                                    <option value="{{ $role->id }}">{{ getRoleName($role->name) }}</option>
                                @endforeach
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
                @else
                    <div @if(count($family ?? []) > 3) style="height: 650px; overflow: auto;" @endif>
                        <div class="row">
                            @foreach($family ?? [] as $key => $input)
                                <div class="card col-sm-4 m-0">
                                    <div class="card-body">
                                        <x-inputs.number
                                            label="Edad"
                                            name="family.{{ $key }}.age"
                                            wire:model.defer="family.{{ $key }}.age"
                                        />
                                        <x-inputs.text
                                            label="Nombre"
                                            name="family.{{ $key }}.name"
                                            wire:model.defer="family.{{ $key }}.name"
                                        />
                                        <x-inputs.select
                                            label="Relación"
                                            name="family.{{ $key }}.relationship"
                                            wire:model.defer="family.{{ $key }}.relationship"
                                        >
                                            <option value="">Tipo de relación</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Padre }}">Padre</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Madre }}">Madre</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Hijo }}">Hijo</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Hija }}">Hija</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Hermano }}">Hermano</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Hermana }}">Hermana</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Abuelo }}">Abuelo</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Abuela }}">Abuela</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Nieto }}">Nieto</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Nieta }}">Nieta</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Tio }}">Tio</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Tia }}">Tia</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Sobrino }}">Sobrino</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Sobrina }}">Sobrina</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::PrimoPrima }}">Primo/Prima
                                            </option>
                                            <option value="{{ \App\Enums\TypeOfKinship::EsposoMarido }}">Esposo/Marido
                                            </option>
                                            <option value="{{ \App\Enums\TypeOfKinship::EsposaMujer }}">Esposa/Mujer
                                            </option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Suegro }}">Suegro</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Suegra }}">Suegra</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Yerno }}">Yerno</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Nuera }}">Nuera</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Cuñado }}">Cuñado</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Cuñada }}">Cuñada</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Padrastro }}">Padrastro</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Madrastra }}">Madrastra</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Hijastro }}">Hijastro</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Hijastra }}">Hijastra</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::MedioHermano }}">Medio Hermano
                                            </option>
                                            <option value="{{ \App\Enums\TypeOfKinship::MediaHermana }}">Media Hermana
                                            </option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Padrino }}">Padrino</option>
                                            <option value="{{ \App\Enums\TypeOfKinship::Madrina }}">Madrina</option>
                                        </x-inputs.select>
                                        <div class="text-end">
                                            <i class="ti ti-square-rounded-letter-x text-danger cursor-pointer"
                                               style="font-size: 30px" wire:click="removeInput({{$key}})"></i>
                                            @if ($loop->last)
                                                <i class="ti ti-circle-plus text-primary cursor-pointer"
                                                   style="font-size: 30px" wire:click="addInput"></i>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-primary" wire:click="saveFamily">Guardar</button>
                            <button type="button" class="btn btn-danger" wire:click="$toggle('showingModal')">
                                Cancelar
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </x-modal>
</div>
