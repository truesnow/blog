<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookmarkRequest;

class BookmarksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    public function index()
    {
        $bookmarks = Bookmark::paginate();
        return view('bookmarks.index', compact('bookmarks'));
    }
}
