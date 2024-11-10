<?php

namespace App\Livewire;

use App\Models\FxNews;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class NewsComponent extends Component
{


    use WithFileUploads;

    //Form Fields

    public $title,
        $description,
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
        $editItem = FxNews::find($edit_id);
        $this->item_edit_id = $editItem->id;
        $this->title = $editItem->title;
        $this->description = $editItem->description;
        $this->image = $editItem->image ? str_replace('public/', 'storage/', $editItem->image) : null;
        $this->openCreateModal();
    }


    public function createItem()
    {
        $this->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image_select' => 'nullable|sometimes|image|max:3072'
        ]);

        $isEditing = $this->item_edit_id != '';
        $item = $isEditing ? FxNews::find($this->item_edit_id) : new FxNews;
        $item->title = $this->title;
        $item->description = $this->description;

        if ($this->image_select) {
            $old_image = $item->image;
            $item->image = $this->image_select->store('public/uploads/news');
            if ($old_image != null) {
                Storage::delete($old_image);
            }
        }

        $item->save();


        if ($isEditing) {
            session()->flash('message', 'Информация о новости "' . $this->title . '" обновлена!');
        } else {
            session()->flash('message', 'Добавлен новость "' . $this->title . '"!');
        }
        
        $this->resetInputFields();
        
        $this->dispatch('close-create-modal');
    }
    public function deleteItem()
    {
        if ($this->item_delete_id == null) {
            return;
        }
        $itemToDelete = FxNews::find($this->item_delete_id);
        $itemToDelete->delete();
        $this->resetInputFields();
        $this->closeDeleteModal();
        session()->flash('message', 'Новость удалена!');
    }

    public function openDeleteModal($i)
    {
        $itemToDelete = FxNews::find($i);
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
        $this->description = '';
        $this->image = '';
        $this->image_select = '';
    }

    public function render()
    {
        $items = FxNews::all();

        return view('livewire.news.index', ['items' => $items])
            ->extends('layouts.master')
            ->section('content');
    }
}
