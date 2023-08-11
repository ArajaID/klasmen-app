<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Standings;

class KlasmenController extends Controller
{
    public function index() {
        $standings = Standings::all();

        return view('klasmen', compact('standings'));
    }
}
