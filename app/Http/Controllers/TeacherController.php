<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\File;
use App\Models\Message;
use Illuminate\Support\Facades\Hash;
use Response;
use Auth;

class TeacherController extends Controller
{

    protected $image_path = '/files/uploads/';

    public function __construct()
    {
        // return $this->middleware(['teacher'], ['except' => 'index'])
    }

    // get all teacher
    public function index(){
        $teachers = User::where('role', 'teacher')
                    ->orderBy('created_at', 'DESC')
                    ->get();

        return view('coordinator.teachers',[
            'teachers'=> $teachers
        ]);
    }

    public function show()
    {

    }

    // create new teacher
    public function store(Request $request){
        
        $this->validate($request, [
            'name'=> 'required',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|confirmed',
        ]);
            
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role'=> 'teacher',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('status', 'Teacher Creation Successful!');

        return back();
    }

    // update teacher by id
    public function update(Request $request, $id)
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
         return Response::json(['class' => 'Success', 'message' => 'Teacher Updated Successfully!']);
        else
            return redirect()->back()->with('error_message', 'Teacher Update Failed!');
    }

    // delete teacher by id
    public function destroy($id){
        $model=User::where('id',$id)->delete();

        return redirect()->back()->with('status', 'Teacher Deletion Successful!');
    }

    public function uploadFile()
    {
        $course = Course::where('teacher_id','=',Auth::user()->id)->first();
        if($course == null)
        {
            return redirect()->back()->with('status','You are not assigned any course!');
        }
        return view('teacher.upload_file',compact('course'));
    }

    // show list of files for that particular class
    public function myUploads($id)
    {
        $course = Course::where('teacher_id','=',$id)->first();
        // dd($course);
        if($course == null)
        {
            return redirect()->back()->with('status','You are not assigned any course!');
        }
        $files = $course->files;

        return view('teacher.upload',compact('course','files'));
    }

    public function uploadFileSubmit(Request $request)
    {
        // dd($request->all());
        $request->validate([
            "file" => "required|mimes:pdf,doc,docx,xls|max:8000"
        ]);
        if($request->has('file')) 
        {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();

            $filePath = public_path() . '/files/uploads/';
            if(!$filePath){
                mkdir($filePath);
            }
            $file->move($filePath, $filename);

            $file = File::create([
                'name' => $filename,
                'course_id' => $request->get('course_id')
            ]);
        }
        return redirect()->back()->with('success','File Upload Successfully!');
    }

    public function deleteFile($id)
    {
        $file = File::findOrFail($id);
        $file->delete();                    // from table delete

        $file_path = public_path() . $this->image_path . $file->name;
        if (file_exists($file_path))        // file delete from folder
            unlink($file_path);

        return redirect()->back()->with('status', 'File Deletion Successful!');

    }

    public function messages()
    {
        // dd(auth()->user()->id);
        $messages = Message::where('teacher_id',auth()->user()->id)->with('studentName')->orderBy('created_at','desc')->get();
        // dd($messages);
        return view('teacher.messages',compact('messages'));
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
