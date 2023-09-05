<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-10">
                <h3 class="fw-semibold mb-4 text-dark-emphasis">Tickets</h3>
            </div>
            <div class="col">
                @can('create', \App\Models\Ticket::class)
                    <button class="btn btn-primary d-flex align-items-center" wire:click="createTicket">
                        <i class="ti ti-circle-plus fs-6 me-2"></i>
                        Nuevo Ticket
                    </button>
                @endcan
            </div>
        </div>
        <livewire:tickets.ticket-table/>
    </div>
    <x-modal wire:model="showingModal">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h5 class="modal-title">Editar</h5>
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
                            name="ticket.description"
                            wire:model="ticket.description"
                        />
                        @if($isEditing)
                            <x-inputs.select
                                label="Estado"
                                name="ticket.status"
                                wire:model="ticket.status"
                            >
                                <option value="">Seleccione un estado</option>
                                <option value="{{ \App\Enums\StatusType::Generado }}">Generado</option>
                                <option value="{{ \App\Enums\StatusType::Asignado }}">Asignado</option>
                                <option value="{{ \App\Enums\StatusType::EnProgreso }}">En Progreso</option>
                                <option value="{{ \App\Enums\StatusType::Finalizado }}">Finalizado</option>
                            </x-inputs.select>
                            <x-inputs.select
                                label="Residente"
                                name="ticket.user_id"
                                wire:model="ticket.user_id"
                            >
                                <option value="generated">Seleccione un residente</option>
                                @forelse($users as $id => $user)
                                    <option value="{{ $id }}">{{ $user }}</option>
                                @empty
                                    <option value="">Sin usuarios</option>
                                @endforelse
                            </x-inputs.select>
                        @endif
                        <x-inputs.select
                            label="Casa"
                            name="ticket.house_id"
                            wire:model="ticket.house_id"
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
                            name="ticket.ticket_category_id"
                            wire:model="ticket.ticket_category_id"
                        >
                            <option value="generated">Seleccione una categoría</option>
                            @forelse($ticketCategories as $id => $ticketCategory)
                                <option value="{{ $id }}">{{ $ticketCategory }}</option>
                            @empty
                                <option value="">Sin Categorías</option>
                            @endforelse
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
