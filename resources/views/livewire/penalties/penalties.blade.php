<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-10">
                <h3 class="fw-semibold mb-4 text-dark-emphasis">Multas</h3>
            </div>
            <div class="col">
                @can('create', \App\Models\Penalty::class)
                    <button class="btn btn-primary d-flex align-items-center" wire:click="createPenalty">
                        <i class="ti ti-circle-plus fs-6 me-2"></i>
                        Nuevo Multa
                    </button>
                @endcan
            </div>
        </div>
        <livewire:penalties.penalties-table/>
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
                        <x-inputs.textarea
                            label="Descripción"
                            name="penalty.description"
                            wire:model="penalty.description"
                        />
                        <x-inputs.number
                            label="Cantidad"
                            name="penalty.amount"
                            wire:model="penalty.amount"
                        />
                        @if($isEditing)
                            <x-inputs.select
                                label="Estado"
                                name="penalty.status"
                                wire:model="penalty.status"
                            >
                                <option value="">Seleccione un estado</option>
                                <option value="{{ \App\Enums\StatusType::Aprobado }}">Aprobado</option>
                                <option value="{{ \App\Enums\StatusType::Rechazado }}">Rechazado</option>
                                <option value="{{ \App\Enums\StatusType::Pagado }}">Pagado</option>
                            </x-inputs.select>
                            <x-inputs.select
                                label="Guardia"
                                name="penalty.user_id"
                                wire:model="penalty.user_id"
                            >
                                <option value="generated">Seleccione un guardia</option>
                                @forelse($users as $id => $user)
                                    <option value="{{ $id }}">{{ $user }}</option>
                                @empty
                                    <option value="">Sin usuarios</option>
                                @endforelse
                            </x-inputs.select>
                        @endif
                        <x-inputs.select
                            label="Casa"
                            name="penalty.house_id"
                            wire:model="penalty.house_id"
                        >
                            <option value="generated">Seleccione una casa</option>
                            @forelse($houses as $id => $house)
                                <option value="{{ $id }}">{!! $house !!}</option>
                            @empty
                                <div></div>
                            @endforelse
                        </x-inputs.select>
                        <x-inputs.select
                            label="Categoría"
                            name="penalty.penalty_category_id"
                            wire:model="penalty.penalty_category_id"
                        >
                            <option value="generated">Seleccione una categoría</option>
                            @forelse($penaltyCategories as $id => $penaltyCategory)
                                <option value="{{ $id }}">{{ $penaltyCategory }}</option>
                            @empty
                                <option value="">Sin Categorías</option>
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
