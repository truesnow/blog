<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motto;

class PagesController extends Controller
{
    public function index()
    {
        $motto = Motto::random();
        return $this->view('pages.index', compact('motto'));
    }
}
