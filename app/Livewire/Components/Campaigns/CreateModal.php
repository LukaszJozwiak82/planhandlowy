<?php

namespace App\Livewire\Components\Campaigns;

use App\Models\Campaign;
use App\Models\Departament;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateModal extends Component
{
    use WithFileUploads;

    public bool $createCampaignModal = false;
    #[Validate('required')]
    public $name;

    #[Validate('required')]
    public $department;

    #[Validate('required|max:1024')]
    public $file;

    #[On('campaign-create')]
    public function openModal()
    {
        $this->createCampaignModal = true;
    }

    public function store()
    {
        $this->validate();
        $fileModel = new Campaign();
        $fileModel->name = $this->name;
        $fileModel->departament_id = $this->department;
        $fileName = time().'_'.$this->file->getClientOriginalName();
        $filePath = $this->file->storeAs(path: 'public/uploads', name: $fileName);
        $fileModel->path = '/storage/'.$filePath;
        $fileModel->save();
        dd($this->file);
    }

    public function render()
    {
        $departments = Departament::query()->byRole(auth()->user())->get();
        return view('livewire.components.campaigns.create-modal', compact('departments'));
    }
}
