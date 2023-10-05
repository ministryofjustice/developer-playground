<?php

namespace App\Http\Controllers;

use App\Models\EventType;
use App\Models\EventTypeTag;
use Illuminate\Http\Request;

class EventTypeTagController extends Controller
{

    public function store(EventType $type)
    {
        $type_id = $type->id ?? null;

        if (!$type_id) {
            return response()->json(['message' => 'Type ID is not valid'], 500);
        }

        $data = $this->validateRequest();
        $data['event_type_id'] = $type_id;

        return EventTypeTag::create($data);
    }

    /**
     * @return array
     */
    protected function validateRequest(): array
    {
        return request()->validate(EventTypeTag::$createRules);
    }
}
