<x-modal center static wire:model="showingDeleteModal">
    <div class="modal-content">
        <div class="modal-header pb-0">
            <h5 class="modal-title">Eliminar</h5>
            <button
                type="button"
                class="btn"
                wire:click="$toggle('showingDeleteModal')"
            >
                <i class="ti ti-x fs-6"></i>
            </button>
        </div>
        <div class="card-body pb-4 px-4 text-center">
            <div class="mb-4">
                <i class="ti ti-info-circle text-danger" style="font-size: 80px"></i>
                <p class="fs-5 text-dark-emphasis">¿Está seguro de eliminar el registro?</p>
            </div>
            <div class="d-flex justify-content-between">
                <button
                    type="button"
                    class="btn btn-danger"
                    wire:click="delete"
                >
                    Eliminar
                </button>
                <button
                    type="button"
                    class="btn btn-secondary"
                    wire:click="$toggle('showingDeleteModal')"
                >
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</x-modal>
