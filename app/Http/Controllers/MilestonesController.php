<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use Illuminate\Http\Request;

class MilestonesController extends Controller
{
    /**
     * 里程碑页面
     */
    public function index(Request $request) {
        $milestones = Milestone::where('type', '=', Milestone::TYPE_FRONTEND)->orderBy('id', 'desc')->get();

        return $this->view('milestones.index', compact('milestones'));
    }
}
