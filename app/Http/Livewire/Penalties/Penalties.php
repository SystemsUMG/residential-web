<?php

namespace App\Http\Livewire\Penalties;

use App\Enums\StatusType;
use App\Enums\UserType;
use App\Models\House;
use App\Models\Penalty;
use App\Models\PenaltyCategory;
use App\Models\User;
use App\Traits\ToastTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Penalties extends Component
{
    use ToastTrait, AuthorizesRequests, WithFileUploads;

    protected $listeners = ['edit', 'delete', 'changeStatus', 'removeFile'];

    public Penalty $penalty;
    public $showingModal = false, $isEditing = false, $modalTitle = '';
    public $houses = [], $users = [], $penaltyCategories = [], $images = [], $files = [];


    protected $rules = [
        'penalty.description' => 'required|string|min:3|max:255',
        'penalty.amount' => 'required|numeric',
        'penalty.status' => 'required_if:isEditing,true',
        'penalty.house_id' => 'required|exists:houses,id',
        'penalty.user_id' => 'required_if:isEditing,true|exists:users,id',
        'penalty.penalty_category_id' => 'required|exists:penalty_categories,id',
        'images.*' => 'mimes:png,jpg,jpeg',
    ];

    public function mount(): void
    {
        $this->houses = House::pluck('name', 'id');
        $this->users = User::whereRelation('roles', 'name', UserType::Guardia)
            ->pluck(DB::raw("CONCAT(name, ' ', surname)"), 'id');
        $this->penaltyCategories = PenaltyCategory::pluck('name', 'id');
    }

    public function createPenalty(): void
    {
        $this->penalty = new Penalty();
        $this->modalTitle = 'Crear multa';
        $this->resetErrorBag();
        $this->images = [];
        $this->files = [];
        $this->isEditing = false;
        $this->showingModal = true;
        $this->penalty->status = StatusType::Generado;
        $this->penalty->user_id = auth()->user()->id;
    }

    public function edit(Penalty $penalty): void
    {
        $this->penalty = $penalty;
        $this->modalTitle = 'Editar multa';
        $this->resetErrorBag();
        $this->images = [];
        $this->files = $this->penalty->images?->pluck('url')->toArray();
        $this->isEditing = true;
        $this->showingModal = true;
    }

    public function delete(Penalty $penalty): void
    {
        try {
            DB::beginTransaction();
            $penalty->delete();
            $this->emit('closeDeleteModal');
            session()->flash('success', 'Multa eliminada');
            $this->redirectRoute('penalties');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->toast('error', errorHelper($e));
        }
    }

    public function changeStatus(Penalty $penalty): void
    {
        try {
            DB::beginTransaction();
            switch ($penalty->status) {
                case StatusType::Pagado->value:
                case StatusType::Generado->value:
                    $penalty->status = StatusType::Aprobado;
                    break;
                case StatusType::Aprobado->value:
                    $penalty->status = StatusType::Rechazado;
                    break;
                case StatusType::Rechazado->value:
                    $penalty->status = StatusType::Pagado;
                    break;
            }
            $penalty->save();
            $this->emit('refreshDatatable');
            $this->toast('success', 'Estado de la multa cambiado');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->toast('error', errorHelper($e));
        }
    }

    public function removeFile($file): void
    {
        try {
            DB::beginTransaction();
            $image = $this->penalty->images()->where('url', $file)->first();
            if ($image->count() === 0) {
                $this->toast('error', 'Archivo no encontrado');
                return;
            }
            $image->delete();
            Storage::disk('public')->delete($file);
            $this->files = $this->penalty->images?->pluck('url')->toArray();
            $this->files = $this->penalty->images()
                ->where('imageable_id', $this->penalty->id)
                ->where('imageable_type', Penalty::class)
                ->pluck('url')
                ->toArray();
            DB::commit();
        } catch (\Exception $e) {
            $this->toast('error', errorHelper($e));
        }
    }

    public function save(): void
    {
        $this->validate();
        try {
            DB::beginTransaction();
            $this->penalty->save();
            if (count($this->images) > 0) {
                foreach ($this->images as $image) {
                    $this->penalty->images()->updateOrCreate(['url' => $image->store('images')]);
                }
            }
            DB::commit();
            $this->showingModal = false;
            $this->emit('refreshDatatable');
            $this->toast('success', $this->isEditing ? 'Ticket editado' : 'Ticket creado');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->toast('error', errorHelper($e));
        }
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $this->authorize('viewAny', Penalty::class);
        return view('livewire.penalties.penalties');
    }
}
