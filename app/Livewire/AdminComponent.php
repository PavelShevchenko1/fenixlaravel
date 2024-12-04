<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AdminComponent extends Component
{
    // Form Fields
    public $name,
        $email,
        $password,
        $password_confirmation;

    // Helpers
    public $item_edit_id,
        $item_delete_id,
        $item_delete_name;

    public function addItem()
    {
        $this->resetInputFields();
        $this->openCreateModal();
    }

    public function editItem($edit_id)
    {
        $this->resetInputFields();
        $editItem = User::find($edit_id);
        $this->item_edit_id = $editItem->id;
        $this->name = $editItem->name;
        $this->email = $editItem->email;
        $this->password = ''; // Do not load the password
        $this->password_confirmation = ''; // Do not load the password
        $this->openCreateModal();
    }

    public function createItem()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|sometimes|string|min:8',
            'password_confirmation' => 'nullable|sometimes|string|min:8|same:password',
        ]);
        
        $isEditing = $this->item_edit_id != '' && $this->item_edit_id != null;
        if(!$isEditing) {
            $this->validate([
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8',
                'password_confirmation' => 'required|string|min:8|same:password',
            ]);
        }

        $item = $isEditing ? User::find($this->item_edit_id) : new User;
        $item->name = $this->name;
        $item->email = $this->email;
        if (!$isEditing || !empty($this->password)) {
            $item->password = Hash::make($this->password);
        }

        $item->save();

        if ($isEditing) {
            session()->flash('message', 'User "' . $this->name . '" updated!');
        } else {
            session()->flash('message', 'User "' . $this->name . '" added!');
        }

        $this->resetInputFields();
        $this->dispatch('close-create-modal');
    }

    public function deleteItem()
    {
        if ($this->item_delete_id == null) {
            return;
        }

        if (Auth::user()->id == $this->item_delete_id) {
            session()->flash('error', 'You cannot delete your own account!');
            return;
        }
        $itemToDelete = User::find($this->item_delete_id);
        $itemToDelete->delete();
        $this->resetInputFields();
        $this->closeDeleteModal();
        session()->flash('message', 'User deleted!');
    }

    public function openDeleteModal($i)
    {
        $itemToDelete = User::find($i);
        $this->item_delete_id = $itemToDelete->id;
        $this->item_delete_name = $itemToDelete->name;
        $this->dispatch('open-delete-modal');
    }

    public function closeDeleteModal()
    {
        $this->resetValidation();
        $this->resetInputFields();
        $this->dispatch('close-delete-modal');
    }

    public function openCreateModal()
    {
        $this->dispatch('open-create-modal');
    }

    public function closeCreateModal()
    {
        $this->resetValidation();
        $this->resetInputFields();
        $this->dispatch('close-create-modal');
    }

    private function resetInputFields()
    {
        $this->item_edit_id = '';
        $this->item_delete_id = '';
        $this->item_delete_name = '';

        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
    }

    public function render()
    {
        $items = User::all();

        return view('livewire.admin.index', ['items' => $items])
            ->extends('layouts.master')
            ->section('content');
    }
}
