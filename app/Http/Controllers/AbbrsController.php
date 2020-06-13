<?php

namespace App\Http\Controllers;

use App\Models\Abbr;
use Illuminate\Http\Request;

/**
 * 缩略词页面控制器
 */
class AbbrsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
        parent::__construct();
    }

    /**
     * 缩略词首页
     */
    public function index(Request $request, Abbr $abbr)
    {
        $countMap = Abbr::getCountMapByFirstLetterGroup();
        $query = Abbr::select();
        if ($request->has('range') && $request->range != '') {
            $query->whereRaw("abbr REGEXP '^[" . $request->range . "]'");
        }
        if ($request->search != '') {
            $search = $request->search;
            $query->where(function ($query) use ($search) {
                $query->where('abbr', '=', $search)
                    ->orWhere('full_name', 'like', '%' . $search . '%')
                    ->orWhere('cn_name', 'like', '%' . $search . '%');
            });
        }
        $abbrs = $query->orderBy('abbr', 'asc')->paginate(20);

        return $this->view('abbrs.index', compact('countMap', 'abbrs'));
    }
}
