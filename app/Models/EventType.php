<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static array $createRules = [
        'name' => 'required|unique:tools|max:80',
        'icon' => 'sometimes|required|string|nullable|starts_with:<path '
    ];

    public function tags()
    {
        return $this->hasMany(EventTypeTag::class);
    }
}
