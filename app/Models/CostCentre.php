<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostCentre extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static array $createRules = [
        'name' => 'required|unique:cost_centres|max:80',
        'number' => 'required|alpha_num'
    ];

    public static array $editRules = [
        'name' => 'required|max:80',
        'number' => 'required|alpha_num'
    ];

    public function path()
    {
        return route('cost-centre', $this->slug);
    }

    public function teams()
    {
        return $this->belongsToMany(\App\Models\Team::class);
    }
}
