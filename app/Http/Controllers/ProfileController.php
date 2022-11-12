<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function coordinator(Request $request, $id){
        $profile = Auth::user();
        return view('coordinator.profile', ['profile' => $profile]);
    }

    public function teacher(Request $request, $id){
        $profile = Auth::user();
        return view('teacher.profile', ['profile' => $profile]);
    }

    public function student(Request $request, $id){
        $profile = Auth::user();
        return view('student.profile', ['profile' => $profile]);
    }
}
