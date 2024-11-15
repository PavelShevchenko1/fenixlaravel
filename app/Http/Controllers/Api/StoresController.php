<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FxStore;
use Illuminate\Http\Request;

class StoresController extends Controller
{
    //get stores
    public function getStores()
    {
        $stores = FxStore::all();
        return response()->json($stores);
    }
}
