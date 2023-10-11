<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use App\Rules\MatchOldPassword;
use App\Traits\ToastTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use ToastTrait, WithFileUploads;

    public Collection $user;
    public $image, $urlImage = [];
    public $currentPassword, $newPassword, $newPassword_confirmation;

    public function mount(): void
    {
        $user = auth()->user();
        if ($user->image) {
            $this->urlImage[] = $user->image->url;
        }
        $this->fill([
            'user' => collect([
                'id' => $user->id,
                'name' => $user->name,
                'surname' => $user->surname,
                'email' => $user->email,
                'phone' => $user->phone,
            ]),
        ]);
    }

    public function saveProfile(): void
    {
        $this->validate([
            'user.name' => 'required|string|max:255',
            'user.surname' => 'required|string|max:255',
            'user.email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'user.phone' => 'required|string|max:255',
            'image' => 'nullable|image|max:1024',
        ]);
        try {
            DB::beginTransaction();
            $user = User::find($this->user['id']);
            $user->update($this->user->toArray());
            if ($this->image) {
                if ($user->image) {
                    $this->image->storeAs('images', basename($user->image->url), 'public');
                } else {
                    $user->image()->create([
                        'url' => $this->image->store('images'),
                    ]);
                }
                $this->image->delete();
            }
            DB::commit();
            session()->flash('success', 'Perfil actualizado');
            $this->redirectRoute('profile');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->toast('error', errorHelper($e));
        }
    }

    public function savePassword(): void
    {
        $this->validate([
            'currentPassword' => ['required', 'string', new MatchOldPassword()],
            'newPassword' => ['required', 'string', 'confirmed'],
        ]);
        try {
            DB::beginTransaction();
            User::whereId($this->user['id'])->update([
                'password' => Hash::make($this->newPassword)
            ]);
            $this->currentPassword = '';
            $this->newPassword = '';
            $this->newPassword_confirmation = '';
            DB::commit();
            $this->toast('success', 'Contraseña cambiada');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->toast('error', errorHelper($e));
        }
    }

    public function removeFile($file): void
    {
        try {
            DB::beginTransaction();
            $user = auth()->user();
            $image = $user->image()->where('url', $file)->first();
            if (!$image) {
                $this->toast('error', 'Archivo no encontrado');
                return;
            }
            $image->delete();
            Storage::disk('public')->delete($file);
            $this->urlImage = $user->image ? [$user->image->url] : [];
            DB::commit();
        } catch (\Exception $e) {
            $this->toast('error', errorHelper($e));
        }
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.profile.profile');
    }
}
