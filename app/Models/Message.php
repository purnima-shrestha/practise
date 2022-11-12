<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['title','body','teacher_id','student_id'];


    // relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function studentName()
    {
        return $this->belongsTo(User::class,'student_id');
    }
    public function teacherName()
    {
        return $this->belongsTo(User::class,'teacher_id');
    }

}
