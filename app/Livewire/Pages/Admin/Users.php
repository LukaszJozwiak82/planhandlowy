<?php

namespace App\Livewire\Pages\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $headers = [
    ['key' => 'name', 'label' => 'Nice Name'],
    ['key' => 'email', 'label' => 'Email'],
    ['key' => 'role', 'label' => 'City'],
    ['key' => 'created_at', 'label' => 'Created At'],
    ];
    public function render()
    {
        $users = User::paginate(10);
        return view('livewire.pages.admin.users',['users'=>$users]);
    }
}
