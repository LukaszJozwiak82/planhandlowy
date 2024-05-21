<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Departament;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    use WithPagination;

    public $headers = [
    ['key' => 'name', 'label' => 'Nice Name'],
    ['key' => 'email', 'label' => 'Email'],
    ['key' => 'role', 'label' => 'Role'],
    ['key' => 'created_at', 'label' => 'Created At'],
    ];
    #[Validate('required')]
    public $departament;

    #[Validate('required|email')]
    public $email;

    #[Validate('required|min:6')]
    public $name;
    public $isOpen = 0;
    public $roles;

    #[Validate('required')]
    public $role;
    public $userId;

    public function mount()
    {
        $this->roles = Role::all();
    }
    public function create()
    {
        $this->openModal();
    }
    public function openModal()
    {
        $this->isOpen = true;
    }
    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function store()
    {
        $this->validate();

        User::updateOrCreate(['email' => $this->email], [
            'departament_id' => $this->departament,
            'email' => $this->email,
        ])->assignRole($this->role);

        session()->flash('message',
            $this->departament ? 'User Created Successfully.' : 'User Updated Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }
    public function render()
    {
        if(auth()->user()->hasRole('admin')) {
            $users = User::paginate(10);
        } else {
            $users = User::where('departament_id', auth()->user()->departament_id)->paginate(10);
        }
        $departments = Departament::all();
        return view('livewire.pages.admin.users',['users'=>$users, 'departments'=>$departments, 'roles'=>$this->roles]);
    }

    private function resetInputFields()
    {
        $this->departament = '';
        $this->email = '';
        $this->role = '';
    }
}
