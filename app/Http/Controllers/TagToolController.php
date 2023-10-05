<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use App\Models\TagTool;
use Illuminate\Http\Request;

class TagToolController extends Controller
{
    public function store(Tool $tool)
    {
        return TagTool::create([
            'tool_id' => $tool->id,
            'tag_id' => request('tag_id')
        ]);
    }
}
