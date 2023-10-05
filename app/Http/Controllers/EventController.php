<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tool;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function store(Request $request, Tool $tool)
    {
        return Event::create([
            'tool_id' => $tool->id,
            'action' => $request->action,
            'detail' => $request->detail,
            'origin' => $request->origin,
            'user_id' => $request->user_id
        ]);
    }
}
