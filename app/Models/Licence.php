<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [
        'start',
        'stop'
    ];

    public function path()
    {
        return '/dashboard/licences/' . $this->id;
    }

    public function setStartAttribute($start)
    {
        $this->attributes['start'] = Carbon::parse($start);
    }

    public function setStopAttribute($stop)
    {
        $this->attributes['stop'] = Carbon::parse($stop);
    }

    public function tool()
    {
        return $this->hasOne(Tool::class, 'id', 'tool_id');
    }

    public function costCentre()
    {
        return $this->hasOne(CostCentre::class, 'id', 'cost_centre_id');
    }

    public function businessCases()
    {
        return $this->hasMany(BusinessCase::class, 'tool_id', 'id')->orderBy('created_at', 'desc');
    }

    /**
     * Usage of licences for a given tool
     * This method will return a percentage value that is representative of the overall
     * use of the tool.
     *
     * @return int|null
     */
    public function getUsageAttribute()
    {
        if ($this->user_limit === null) {
            return 0;
        }

        return $this->attributes['usage'] = (int)(($this->users_current / $this->user_limit) * 100);
    }
}
