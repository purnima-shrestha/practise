<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Course extends Model
{
    use HasFactory;


    protected $fillable = ['name','teacher_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'teacher_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class,'course_student' ,'course_id' ,'student_id');
    }

    public function files(){
        return $this->hasMany(File::class);
    }

    // accessors
    public function getNameAttribute($value)
    {
    	return ucwords($value);
    }
}
