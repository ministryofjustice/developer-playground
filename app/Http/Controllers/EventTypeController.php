<?php

namespace App\Http\Controllers;

use App\Models\EventType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventTypeController extends Controller
{
    public function store()
    {
        return EventType::create($this->validateRequest());
    }

    /**
     * @return array
     */
    protected function validateRequest(): array
    {
        return request()->validate(EventType::$createRules);
    }
}
