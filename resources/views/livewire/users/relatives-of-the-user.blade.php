<x-modal wire:model="seeFamilyModal">
    <div class="modal-content">
        <div class="modal-header pb-0">
            <h5 class="modal-title">Familiares</h5>
            <button
                type="button"
                class="btn"
                wire:click="$toggle('seeFamilyModal')">
                <i class="ti ti-x fs-6"></i>
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="height:450px!important;">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Relación</th>
                        <th scope="col">Edad</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($value as $index => $item)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{!! $item['name'] ?? '--' !!}</td>
                            <td>{!! $item['relationship'] ?? '--' !!}</td>
                            <td>{!! $item['age'] ?? '--' !!}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No hay familiares registrados</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-end">
                <button
                    type="button"
                    class="btn btn-danger"
                    wire:click="$toggle('seeFamilyModal')">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</x-modal>
