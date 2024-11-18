<?php

namespace App\Livewire;

use App\Models\FxAppUserGroup;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class UserGroupsComponent extends Component
{

    //Form Fields

    public $title,
            $age_from,
            $age_to,
            $barcode;

    //Helpers
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
        $editItem = FxAppUserGroup::find($edit_id);
        $this->item_edit_id = $editItem->id;
        $this->title = $editItem->title;
        $this->age_from = $editItem->age_from;
        $this->age_to = $editItem->age_to;
        $this->barcode = $editItem->barcode;
        $this->openCreateModal();
    }


    public function createItem()
    {
        $this->validate([
            'title' => 'required|string',
            'age_from' => 'required|integer',
            'age_to' => 'required|integer',
            'barcode' => 'required|string',
        ]);

        $isEditing = $this->item_edit_id != '';
        $item = $isEditing ? FxAppUserGroup::find($this->item_edit_id) : new FxAppUserGroup;
        $item->title = $this->title;
        $item->age_from = $this->age_from;
        $item->age_to = $this->age_to;
        $item->barcode = $this->barcode;

        $item->save();


        if ($isEditing) {
            session()->flash('message', 'Информация о группе "' . $this->title . '" обновлена!');
        } else {
            session()->flash('message', 'Добавлена группа пользователей "' . $this->title . '"!');
        }

        $this->resetInputFields();

        $this->dispatch('close-create-modal');
    }
    public function deleteItem()
    {
        if ($this->item_delete_id == null) {
            return;
        }
        $itemToDelete = FxAppUserGroup::find($this->item_delete_id);
        $itemToDelete->delete();
        $this->resetInputFields();
        $this->closeDeleteModal();
        session()->flash('message', 'Новость удалена!');
    }

    public function openDeleteModal($i)
    {
        $itemToDelete = FxAppUserGroup::find($i);
        $this->item_delete_id = $itemToDelete->id;
        $this->item_delete_name = $itemToDelete->title;
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

        $this->title = '';
        $this->age_from = '';
        $this->age_to = '';
        $this->barcode = '';
    }

    public function render()
    {
        $items = FxAppUserGroup::all();

        return view('livewire.groups.index', ['items' => $items])
            ->extends('layouts.master')
            ->section('content');
    }
}
