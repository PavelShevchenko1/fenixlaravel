<?php

namespace App\Livewire;

use App\Models\FxAppUser;
use Livewire\Component;
use Livewire\WithPagination;

class UsersComponent extends Component
{
    public $item_delete_id;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $perPage = 10;
    public $currentPage = 1;

    public function render()
    {
        $items = FxAppUser::orderBy('updated_at', 'desc')->paginate($this->perPage, ['*'], 'page', $this->currentPage);

        return view('livewire.users.index', ['items' => $items])
            ->extends('layouts.master')
            ->section('content');
    }

    

    public function openDeleteModal($i)
    {
        $itemToDelete = FxAppUser::find($i);
        $this->item_delete_id = $itemToDelete->session_id;
        $this->dispatch('open-delete-modal');
    }

    public function deleteItem()
    {
        FxAppUser::destroy($this->item_delete_id);
        $this->dispatch('close-delete-modal');
        session()->flash('message', 'Сессия удалена!');
    }

    public function closeDeleteModal()
    {
        $this->resetValidation();
        $this->resetInputFields();
        $this->dispatch('close-delete-modal');
    }

    public function resetInputFields()
    {
        $this->item_delete_id = '';
    }


    
    public function gotoPage($page)
    {
        $this->currentPage = $page;
    }

    public function nextPage()
    {
        $this->currentPage++;
    }

    public function previousPage()
    {
        $this->currentPage--;
    }
}
