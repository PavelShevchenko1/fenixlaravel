<?php

namespace App\Livewire;

use App\Models\FxAppUser;
use Livewire\Component;

class UsersComponent extends Component
{
    public function render()
    {
        $items = FxAppUser::orderBy('updated_at', 'desc')->get();

        return view('livewire.users.index', ['items' => $items])
            ->extends('layouts.master')
            ->section('content');
    }
}
