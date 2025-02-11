<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\CreateUserForm;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateUser extends Component
{
    #[Validate('required|email|unique:users,email')]
    public string $email = '';

    #[Validate('required|string|min:8')]
    public string $password = '';

    #[Validate('required|string|min:3')]
    public string $name = '';

    public function render()
    {
        return view('livewire.auth.create-user');
    }
}
