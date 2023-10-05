<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static array $createRules = [
        'name' => 'required|unique:tags|max:80'
    ];

    public function tools()
    {
        return $this->belongsToMany(\App\Models\Tool::class)->withPivot('name')->withTimestamps();
    }
}
