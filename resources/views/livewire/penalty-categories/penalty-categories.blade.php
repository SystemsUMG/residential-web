<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-10">
                <h3 class="fw-semibold mb-4 text-dark-emphasis">Categorías de multas</h3>
            </div>
            <div class="col">
                @can('create', \App\Models\PenaltyCategory::class)
                    <button class="btn btn-primary d-flex align-items-center" wire:click="createPenalty">
                        <i class="ti ti-circle-plus fs-6 me-2"></i>
                        Nueva categoría
                    </button>
                @endcan
            </div>
        </div>
        <livewire:penalty-categories.penalty-categories-table/>
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
                            name="penaltyCategory.name"
                            wire:model="penaltyCategory.name"
                        />
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
