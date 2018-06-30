<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Articles;

class SubjectsController extends Controller
{
    public function index()
    {
        $subjects = Subject::where('parent_id', 0)->get();
        $count = $subjects->count();

        return $this->view('subjects.index', compact('subjects', 'count'));
    }

    public function show(Subject $subject)
    {
        if ($subject->parent_id == 0) {
            // 一级专题
            $child_subjects = Subject::where('parent_id', $subject->id)->get();

            return $this->view('subjects.show', compact('subject', 'child_subjects'));
        } else {
            // 二级专题
            $articles = $subject->articles()->with('user', 'subject')->paginate(10);
            $article_count = $subject->articles()->with('user', 'subject')->count();

            return $this->view('subjects.show', compact('subject', 'articles', 'article_count'));
        }
    }
}
