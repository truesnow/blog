<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\BookmarkCategory;
use Illuminate\Http\Request;
use App\Http\Requests\BookmarkRequest;

class BookmarksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
        parent::__construct();
    }

    public function index()
    {
        $bookmarks = Bookmark::nav();

        return $this->view('bookmarks.index', compact('bookmarks'));
    }
}
