<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function path()
    {
        return '/dashboard/contacts/' . $this->slug;
    }

    public function tools()
    {
        return $this->hasMany(Tool::class, 'contact_id', 'id');
    }

    public function name()
    {
        return $this->morphOne(Tool::class, 'contact');
    }
}
