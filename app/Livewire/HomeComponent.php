<?php

namespace App\Livewire;

use App\Models\FxAppUser;
use App\Models\FxAppUserGroup;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $allUsersCount = FxAppUser::count();
        $ageGenderData = FxAppUser::select('gender', 'birth_date')->get();
        $ageGroups = FxAppUserGroup::all();
        $platformData = FxAppUser::select('platform')->get();
        return view('livewire.home.index', compact('ageGenderData', 'ageGroups', 'platformData', 'allUsersCount'))
            ->extends('layouts.master')
            ->section('content');
    }
}
