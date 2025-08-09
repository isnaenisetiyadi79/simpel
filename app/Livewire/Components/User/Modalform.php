<?php

namespace App\Livewire\Components\User;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\On;

class Modalform extends Component
{
    public $modalFormData = false;

    public $id;
    public $update_data = false;

    public $name;
    public $email;
    public $password;
    public $role;
    #[On('open-modal')]
    public function openModal()
    {
        $this->modalFormData = true;
    }

    #[On('edit-modal')]
    public function editModal($id)
    {

        $this->id = $id;
        $this->update_data = true;
        $this->modalFormData = true;

        $user = User::find($id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles->pluck('id')->toArray();
    }

    public function closeModal()
    {
        $this->modalFormData = false;
        $this->reset();
    }

    public function getRoles()
    {
        return Role::all();
    }
    public function save()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
        ]);

        if ($this->update_data) {
            $user = User::find($this->id);
            $user->name = $this->name;
            $user->email = $this->email;
            if ($this->password) {
                $user->password = $this->password;
            }

            $user->save();
            $user->roles()->sync($this->role);
            $this->reset();
            $this->dispatch('success', 'User updated successfully');
        } else {
            $this->validate([
                'password' => 'required'
            ]);


            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password)
            ]);
            $user->roles()->sync($this->role);
            $this->reset();
            $this->dispatch('success', 'User created successfully');
        }


        $this->closeModal();
    }
    public function render()
    {
        return view('livewire.components.user.modalform', [
            'roles' => $this->getRoles(),
        ]);
    }
}
