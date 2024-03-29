<?php

namespace App\Livewire;

use App\Http\Resources\UserCollection;
use App\Models\User as UserModel;
use Livewire\Component;

class User extends Component
{
    public function render()
    {
        return view('livewire.user',
            [
                'users' => new UserCollection(UserModel::all()),
            ]);
    }
}
