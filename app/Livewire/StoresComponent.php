<?php

namespace App\Livewire;

use App\Models\FxStore;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class StoresComponent extends Component
{


    use WithFileUploads;

    //Form Fields

    public $uptitle,
        $title,
        $phone,
        $hours,
        $weekend_plan,
        $image_select,
        $image;

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
        $editItem = FxStore::find($edit_id);
        $this->item_edit_id = $editItem->id;
        $this->uptitle = $editItem->uptitle;
        $this->title = $editItem->title;
        $this->phone = $editItem->phone;
        $this->hours = $editItem->hours;
        $this->weekend_plan = $editItem->weekend_plan;
        $this->image = $editItem->image ? str_replace('public/', 'storage/', $editItem->image) : null;
        $this->openCreateModal();
    }


    public function createItem()
    {
        $this->validate([
            'uptitle' => 'nullable|sometimes|string',
            'title' => 'nullable|sometimes|string',
            'phone' => 'nullable|sometimes|string',
            'hours' => 'nullable|sometimes|string',
            'weekend_plan' => 'nullable|sometimes|string',
            'image_select' => 'nullable|sometimes|image|max:3072'
        ]);

        $isEditing = $this->item_edit_id != '';
        $item = $isEditing ? FxStore::find($this->item_edit_id) : new FxStore;
        $item->uptitle = $this->uptitle;
        $item->title = $this->title;
        $item->phone = $this->phone;
        $item->hours = $this->hours;
        $item->weekend_plan = $this->weekend_plan;

        if ($this->image_select) {
            $old_image = $item->image;
            $item->image = $this->image_select->store('public/uploads/stores');
            if ($old_image != null) {
                Storage::delete($old_image);
            }
        }

        $item->save();


        if ($isEditing) {
            session()->flash('message', 'Информация о магазине "' . $this->title . '" обновлена!');
        } else {
            session()->flash('message', 'Добавлен магазин "' . $this->title . '"!');
        }
        
        $this->resetInputFields();
        
        $this->dispatch('close-create-modal');
    }
    public function deleteItem()
    {
        if ($this->item_delete_id == null) {
            return;
        }
        $itemToDelete = FxStore::find($this->item_delete_id);
        $itemToDelete->delete();
        $this->resetInputFields();
        $this->closeDeleteModal();
        session()->flash('message', 'Магазин удален!');
    }

    public function openDeleteModal($i)
    {
        $itemToDelete = FxStore::find($i);
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

        $this->uptitle = '';
        $this->title = '';
        $this->phone = '';
        $this->hours = '';
        $this->weekend_plan = '';
        $this->image = '';
        $this->image_select = '';
    }

    public function render()
    {
        $items = FxStore::all();

        return view('livewire.stores.index', ['items' => $items])
            ->extends('layouts.master')
            ->section('content');
    }
}
