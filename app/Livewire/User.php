<?php

namespace App\Livewire;

use App\Http\Resources\UserCollection;
use Livewire\Component;
use App\Models\User as UserModel;

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
