<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Response;
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::with('user')->get();

        $teachers = User::where('role', "teacher")->orderBy('name')->get();

        return view('coordinator.courses.index',[
            'courses' => $courses, 
            'teachers' => $teachers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $row = Course::create($request->all());
        if($row)
            return redirect()->route('courses.index')->with('message', 'Course created successfully!');
        else
            return redirect()->back()->with('message', 'Course could not be created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        // $course = Course::findOrFail($course);

        // return view('coordinator.courses.show', compat('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         $validator = $this->validate($request, [
            'name'=> 'required|unique:courses,name,'.$request->id,
            'teacher_id'=> 'required'
        ]);
        // dd($request->all());
        $course = Course::findOrFail($request->get('id'));

        $row = $course->update($request->all());

        if($row)
            return Response::json(['class' => 'Success', 'message' => 'Course Updated Successfully!']);
        else
             return redirect()->back()->with('message', 'Course Could Not Be Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {

        $course->delete();

        return redirect()->back();
    }
}
