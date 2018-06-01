<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectsController extends Controller
{
    public function index()
    {
        $subjects = Subject::where('parent_id', 0)->get();
        $count = $subjects->count();

        return $this->view('subjects.index', compact('subjects', 'count'));
    }
}
