<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class File extends Model
{

    protected $fillable = ['name','course_id'];

    // relationship
    public function course()
    {
    	return $this->belongsTo(Course::class,'course_id');
    }

    // accesor
    public function getCreatedAtAttribute($value)
    {
    	return Carbon::parse($value)->diffForHumans();
    }
    
}
