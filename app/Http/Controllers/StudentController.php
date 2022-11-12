<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Message;
use Response;

class StudentController extends Controller
{
	protected $folder = "/files/uploads/";
   // get all teacher
    public function index(){
        $students = User::where('role', 'student')
                    ->orderBy('created_at', 'DESC')
                    ->get();

        return view('coordinator.students',[
            'students'=> $students
        ]);
    }

    public function update(Request $request,$id)
    {
    	$this->validate($request, [
            'name'=> 'required',
            'email'=> 'required|email|unique:users,email,'.$id,
            'password'=> 'sometimes|confirmed',
        ]);

        // dd($request->all());
        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $row = $user->save();

        if($row)
         return Response::json(['class' => 'Success', 'message' => 'Student Updated Successfully!']);
        else
            return redirect()->back()->with('error_message', 'Student Update Failed!');

    }

    public function chooseCourse()
    {
    	$courseId = \Auth::user()->courses->pluck('id');
    	$courses = Course::whereNotIn('id', $courseId)->get();
    	$selectedCourses = Course::whereIn('id', $courseId)->get();
    	// dd($selectedCourses);
    	// dd($courses);
    	return view('student.course',compact('courses','selectedCourses'));
    }

    public function chooseCourseSubmit(Request $request,$id)
    {
    	// dd($request->all());
    	$student = User::findOrFail($id)->where('role','=','student')->first();
    	// dd($student);
    	$student->courses()->sync($request->get('course'));
    	return redirect()->back()->with('success','Course Chosen Successfully!');
    }


    public function fileList()
    {
    	// dd();
    	// $student = auth()->user();
    	// $rows = $student->courses;
    	$student = User::where('id',auth()->user()->id)->with('courses')->first();
    	// dd($student->courses->first()->files);
    	return view('student.download',compact('student'));
    }

    public function download($file_name)
    {
    	// dd($file_name);
    	$student = auth()->user();
    	$student->download_count = $student->download_count + 1;
    	$student->save();
    	// dd($student);
    	$file_path = public_path($this->folder.$file_name);
    	return response()->download($file_path);
    }


    public function messages()
    {
        $messages = Message::where('student_id',auth()->user()->id)->orderBy('created_at','desc')->get();
        // dd($messages);
        $teachers = User::where('role','teacher')->get();
        // dd('mesasges');
        return view('student.messages',compact('messages','teachers'));
    }

    public function sendMessage(Request $request)
    {
        // dd($request->all());
        $row = Message::create($request->all());
        if($row)
            return redirect()->back()->with('status', 'Message Sent Successfully!!!');
        else
            return redirect()->back()->with('error_message', 'Message Not Send!!');
    }
}

