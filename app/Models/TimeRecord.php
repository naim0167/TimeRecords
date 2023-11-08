<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'start_time',
        'end_time'
    ];

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function getTotalHoursAttribute(){
        $to = Carbon::parse($this->start_time);
        $from = Carbon::parse($this->end_time);

        $differenceInHours = $to->diff($from)->format('%H:%I');
        return $differenceInHours;
    }

}
