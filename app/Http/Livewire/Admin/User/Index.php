<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name,$email,$password,$role_as, $user_id;
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role_as' => 'required|integer'
        ];
    }
    public function resetInput()
    {
        $this->name = NULL;
        $this->email = NULL;
        $this->password = NULL;
        $this->role_as = NULL;
        $this->user_id = NULL;
    }
    public function closeModal() 
    {
        $this->resetInput();
    }
    public function openModal() 
    {
        $this->resetInput();
    }
    public function storeUser()
    {
        $validatedData = $this->validate();
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role_as' => $this->role_as
        ]);
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
        $this->dispatchBrowserEvent('success', ['message' => 'User Created Successfully']);
    }
    public function editUser(int $user_id)
    {
        $this->user_id = $user_id;
        $user = User::findOrFail($user_id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->role_as = $user->role_as;
    }
    public function updateUser()
    {
        $user = User::findOrFail($this->user_id);
        if ($user) {
            if ($user->email != $this->email) {
                if ($user->email == Auth::user()->email) {
                    $this->dispatchBrowserEvent('error', ['message' => 'Opps! You are logged In']);
                } else {
                    $validatedData = $this->validate();
                    if ($user->role_as != '1') {
                        if ($this->password == $user->password) {
                            $user->update([
                                'name' => $this->name,
                                'email' => $this->email,
                                'role_as' => $this->role_as
                            ]);
                        } else {
                            $user->update([
                                'name' => $this->name,
                                'email' => $this->email,
                                'password' => Hash::make($this->password),
                                'role_as' => $this->role_as,
                            ]);
                        }
                        $this->dispatchBrowserEvent('success', ['message' => 'User Updated Successfully']);
                    } else {
                        if ($this->password == $user->password) {
                            $user->update([
                                'name' => $this->name,
                                'email' => $this->email
                            ]);
                        } else {
                            $user->update([
                                'name' => $this->name,
                                'email' => $this->email,
                                'password' => Hash::make($this->password),
                            ]);
                        }
                        $this->dispatchBrowserEvent('success', ['message' => 'User Updated Successfully']);
                    }
                }
            }else{
                if ($user->role_as != '1') {
                    if ($this->password == $user->password) {
                        $user->update([
                            'name' => $this->name,
                            'role_as' => $this->role_as
                        ]);
                    } else {
                        $user->update([
                            'name' => $this->name,
                            'password' => Hash::make($this->password),
                            'role_as' => $this->role_as,
                        ]);
                    }
                } else {
                    if ($this->password == $user->password) {
                        $user->update([
                            'name' => $this->name
                        ]);
                    } else {
                        $user->update([
                            'name' => $this->name,
                            'password' => Hash::make($this->password),
                        ]);
                    }
                }
                $this->dispatchBrowserEvent('success', ['message' => 'User Updated Successfully']);
            }
        }else{
            $this->dispatchBrowserEvent('error', ['message' => 'User does not exist']);
        }
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }
    public function deleteUser($user_id)
    {
        $this->user_id = $user_id;
    }
    public function destroyUser()
    {
        $user = User::findOrFail($this->user_id);
        if ($user) {
            if ($user->email == Auth::user()->email) {
                $this->dispatchBrowserEvent('error', ['message' => 'Opps! You are logged In']);
            } else {
                $user->delete();
                $this->dispatchBrowserEvent('success', ['message' => 'User Deleted Successfully']);
            }
        } else {
            $this->dispatchBrowserEvent('error', ['message' => 'User Already Deleted']);
        } 
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }
    public function render()
    {
        $users = User::orderby('user_id', 'DESC')->paginate(5);
        return view('livewire.admin.user.index', compact('users'))
                ->extends('layouts.admin')
                ->section('content');
    }
}
