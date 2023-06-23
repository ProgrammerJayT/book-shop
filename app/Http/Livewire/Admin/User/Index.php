<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Index extends Component
{
    public $name,$email,$password,$role;
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|integer'
        ];
    }
    public function resetInput()
    {
        $this->name = NULL;
        $this->email = NULL;
        $this->password = NULL;
        $this->role = NULL;
    }
    public function storeUser()
    {
        $validatedData = $this->validate();
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role_as' => $this->role
        ]);
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
        $this->dispatchBrowserEvent('success', ['message' => 'User Created Successfully']);
    }
    public function render()
    {
        return view('livewire.admin.user.index')
                ->extends('layouts.admin')
                ->section('content');
    }
}
