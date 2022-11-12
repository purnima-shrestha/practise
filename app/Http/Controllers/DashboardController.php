<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\File;
use App\Models\Course;

class DashboardController extends Controller
{
     public function index()
    {
        $coordinators = User::where('role', "coordinator")->count();
        $teachers = User::where('role', "teacher")->count();
        $students = User::where('role', "student")->count();
        $courses = Course::count();

        // teacher dashboard
        // $uploadCount = Auth::user()->get('upload_count');
        $teacher = Auth::user()->with('course')->first();
        // dd($teacher);
        $course_id = optional($teacher->course)->id;
        $uploadCount = File::where('course_id',$course_id)->count();

        // student dashboard
        // $downloadCount = User::where('role', "student")->get('download_count');
        $downloadCount = \Auth::user()->download_count;


        if(!Auth::check()){
            return redirect()->route('login');
        }
        // coordinator
        if(Auth::user()->role == 'coordinator'){
            return view('coordinator.index',[
                'coordinators' => $coordinators, 
                'teachers' => $teachers,
                'students' => $students,
                'courses' => $courses,
            ]);
        }

        // teacher
        if(Auth::user()->role == 'teacher'){
            return view('teacher.index',[
                'teachers' => $teachers,
                'students' => $students,
                'courses' => $courses,
                'uploadCount'=> $uploadCount
            ]);
        }
        // student
        if(Auth::user()->role == 'student'){
            return view('student.index',[
                'teachers' => $teachers,
                'students' => $students,
                'courses' => $courses,
                'downloadCount'=> $downloadCount
            ]);
        }
    }
}
