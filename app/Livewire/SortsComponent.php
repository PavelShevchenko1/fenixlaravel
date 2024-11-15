<?php

namespace App\Livewire;

use App\Models\FxBeerSort;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class SortsComponent extends Component
{


    use WithFileUploads;

    //Form Fields

    public $descr,
        $image_select,
        $image;

    //Helpers
    public $item_edit_id,
        $item_delete_id;


    public function addItem()
    {
        $this->resetInputFields();
        $this->openCreateModal();
    }

    public function editItem($edit_id)
    {
        $this->resetInputFields();
        $editItem = FxBeerSort::find($edit_id);
        $this->item_edit_id = $editItem->id;
        $this->descr = $editItem->descr;
        $this->image = $editItem->image ? str_replace('public/', 'storage/', $editItem->image) : null;
        $this->openCreateModal();
    }


    public function createItem()
    {
        $this->validate([
            'descr' => 'required|string',
            'image_select' => 'nullable|sometimes|image|max:3072'
        ]);

        $isEditing = $this->item_edit_id != '';
        $item = $isEditing ? FxBeerSort::find($this->item_edit_id) : new FxBeerSort;
        $item->descr = $this->descr;

        if ($this->image_select) {
            $old_image = $item->image;
            $item->image = $this->image_select->store('public/uploads/sorts');
            if ($old_image != null) {
                Storage::delete($old_image);
            }
        }

        $item->save();


        if ($isEditing) {
            session()->flash('message', 'Информация о сорте обновлена!');
        } else {
            session()->flash('message', 'Добавлен сорт!');
        }

        $this->resetInputFields();

        $this->dispatch('close-create-modal');
    }
    public function deleteItem()
    {
        if ($this->item_delete_id == null) {
            return;
        }
        $itemToDelete = FxBeerSort::find($this->item_delete_id);
        $itemToDelete->delete();
        $this->resetInputFields();
        $this->closeDeleteModal();
        session()->flash('message', 'Новость удалена!');
    }

    public function openDeleteModal($i)
    {
        $itemToDelete = FxBeerSort::find($i);
        $this->item_delete_id = $itemToDelete->id;
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
        $this->descr = '';
        $this->image = '';
        $this->image_select = '';
    }

    public function render()
    {
        $items = FxBeerSort::all();

        return view('livewire.sorts.index', ['items' => $items])
            ->extends('layouts.master')
            ->section('content');
    }
}
