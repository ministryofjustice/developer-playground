<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['organisation'];

    public static array $createRules = [
        'name' => 'required|unique:organisations|max:120',
        'comms_url' => '',
        'organisation_id' => 'required|integer|numeric',
        'cost_centre_id' => 'sometimes|integer|numeric',
    ];

    public function path()
    {
        return '/dashboard/teams/' . $this->slug;
    }

    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    public function setOrganisationAttribute()
    {
        return $this->with('organisation');
    }
}
