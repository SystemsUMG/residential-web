<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-10">
                <h3 class="fw-semibold mb-4 text-dark-emphasis">Casas</h3>
            </div>
            <div class="col">
                @can('create', \App\Models\House::class)
                    <button class="btn btn-primary d-flex align-items-center" wire:click="createHouse">
                        <i class="ti ti-circle-plus fs-6 me-2"></i>
                        Nueva casa
                    </button>
                @endcan
            </div>
        </div>
        <livewire:houses.houses-table/>
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
                            name="house.name"
                            wire:model="house.name"
                        />
                        <x-inputs.text
                            label="Código"
                            name="house.code"
                            wire:model="house.code"
                        />
                        <x-inputs.select
                            label="Propietario"
                            name="house.user_id"
                            wire:model="house.user_id"
                        >
                            <option value="">Seleccione un propietario</option>
                            @forelse($users as $id => $user)
                                <option value="{{ $id }}">{{ $user }}</option>
                            @empty
                                <option value="">Sin usuarios</option>
                            @endforelse
                        </x-inputs.select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button
                            type="submit"
                            class="btn btn-primary"
                            wire:click="save"
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
