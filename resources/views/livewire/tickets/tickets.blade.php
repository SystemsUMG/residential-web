<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-10">
                <h3 class="fw-semibold mb-4 text-dark-emphasis">Tickets</h3>
            </div>
            <div class="col">
                <button class="btn btn-primary d-flex align-items-center">
                    <i class="ti ti-circle-plus fs-6 me-2"></i>
                    Nuevo Ticket
                </button>
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
                <div class="row">
                    <x-inputs.textarea
                        label="Descripción"
                        name="ticket.description"
                        wire:model="ticket.description"
                    />
                    <x-inputs.select
                        label="Estado"
                        name="ticket.status"
                        wire:model="ticket.status"
                    >
                        <option value="generated">Generado</option>
                        <option value="assigned">Asignado</option>
                        <option value="in_progress">En progreso</option>
                        <option value="finalized">Finalizado</option>
                    </x-inputs.select>
                    <x-inputs.select
                        label="Estado"
                        name="ticket.house_id"
                        wire:model="ticket.house_id"
                    >
                        @forelse($houses as $id => $house)
                            <option value="{{ $id }}">{!! $house !!}</option>
                        @empty
                            <div></div>
                        @endforelse
                    </x-inputs.select>
                    <x-inputs.select
                        label="Usuario"
                        name="ticket.user_id"
                        wire:model="ticket.user_id"
                    >
                        @forelse($users as $id => $user)
                            <option value="{{ $id }}">{{ $user }}</option>
                        @empty
                            <div></div>
                        @endforelse
                    </x-inputs.select>
                    <x-inputs.select
                        label="Usuario"
                        name="ticket.user_id"
                        wire:model="ticket.user_id"
                    >
                        @forelse($ticketCategories as $id => $ticketCategory)
                            <option value="{{ $id }}">{{ $ticketCategory }}</option>
                        @empty
                            <div></div>
                        @endforelse
                    </x-inputs.select>
                </div>
                <div class="d-flex justify-content-between">
                    <button
                        type="button"
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
            </div>
        </div>
    </x-modal>
</div>
