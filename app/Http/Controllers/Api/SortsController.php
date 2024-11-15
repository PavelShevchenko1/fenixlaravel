<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FxBeerSort;
use Illuminate\Http\Request;

class SortsController extends Controller
{
    //get sorts
    public function getSorts()
    {
        $sorts = FxBeerSort::all();
        return response()->json($sorts);
    }
}
