<?php

namespace App\Livewire\Components\User;

use App\Models\User;
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
    }

    public function closeModal()
    {
        $this->modalFormData = false;
        $this->reset();
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
            $this->reset();
            $this->dispatch('success', 'User created successfully');
        }


        $this->closeModal();
    }
    public function render()
    {
        return view('livewire.components.user.modalform');
    }
}
