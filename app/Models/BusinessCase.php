<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessCase extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static array $createRules = [
        'name' => 'required|unique:business_cases|max:80',
        'link' => 'required-without:text',
        'text' => 'required-without:link',
        'tool_id' => ''
    ];

    public function path()
    {
        return '/dashboard/business-cases/' . $this->slug;
    }

    public function tool(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Tool::class, 'id', 'tool_id');
    }

    public function licence(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Licence::class, 'id', 'licence_id');
    }
}
