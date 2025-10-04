<?php

namespace App\Livewire\Components\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RubahPassword extends Component
{

    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function rules()
    {
        return [
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed|different:current_password',
        ];
    }

    public function updatePassword()
    {
        $this->validate();

        $user = Auth::user();

        // Cek password lama
        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'Password lama tidak sesuai.');
            return;
        }

        // Update password
        $user->password = Hash::make($this->new_password);
        $user->save();

        // Reset field form
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);

        // Kirim notifikasi ke front
        // $this->dispatch('success', message: 'Password berhasil diperbarui.');
        session()->flash('success', 'Password berhasil diperbarui.');
    }
    public function render()
    {
        return view('livewire.components.user.rubah-password');
    }
}
