<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Response;


class CoordinatorController extends Controller
{

    public function __construct()
    {
        // return $this->middleware(['coordinator'], ['except' => 'index'])
    }

    // get all coordinator
    public function index(){
        $coordinators = User::where('role', 'coordinator')
                    ->orderBy('created_at', 'DESC')
                    ->get();

        return view('coordinator.coordinators',[
            'coordinators'=> $coordinators
        ]);
    }

    // create new coordinator
    public function store(Request $request){
        
        $this->validate($request, [
            'name'=> 'required',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|confirmed',
        ]);
            
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role'=> 'coordinator',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('status', 'Coordinator Created Successfully!');

    }

    // update coordinator by id
    public function update(Request $request, $id)
    {
        $validator = $this->validate($request, [
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
         return Response::json(['class' => 'Success', 'message' => 'Coordinator Updated Successfully!']);
        else
            return redirect()->back()->with('error_message', 'Coordinator Update Failed!');
    }

    // delete coordinator by id
    public function destroy($id){
        $model=User::where('id',$id)->delete();

        return redirect()->back()->with('status', 'Coordinator Deletion Successful!');
    }
}
