<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CoordinatorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home','App\Http\Controllers\DashboardController@index')->name('dashboard');

Auth::routes();

// dynamic dashboard route
Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
// different profile routes because of different layouts
Route::get('/coordinator/profile/{id}', 'App\Http\Controllers\ProfileController@coordinator')->name('profile.coordinator');
Route::get('/teacher/profile/{id}', 'App\Http\Controllers\ProfileController@teacher')->name('profile.teacher');
Route::get('/student/profile/{id}', 'App\Http\Controllers\ProfileController@student')->name('profile.student');

// get all students
Route::get('/student', 'App\Http\Controllers\StudentController@index')->name('student')->middleware('coordinator');
Route::get('/choose/course', 'App\Http\Controllers\StudentController@chooseCourse')->name('choose.course')->middleware('student');
Route::post('/choose/course/{id}', 'App\Http\Controllers\StudentController@chooseCourseSubmit')->name('choose.course.submit')->middleware('student');
Route::post('student/update/{id}','App\Http\Controllers\StudentController@update')->name('student.update');

// coordinator
Route::resource('coordinator', CoordinatorController::class,[
    'names' => [
        'index' => 'coordinator',
        'store' => 'coordinator.new',
        'destroy' => 'coordinator.delete',
    ]
])->except('update');
Route::post('coordinator/update/{id}','App\Http\Controllers\CoordinatorController@update')->name('coordinator.update');


// teacher
Route::resource('teacher', TeacherController::class,[
    'names' => [
        'index' => 'teacher',
        'store' => 'teacher.new',
        'destroy' => 'teacher.delete',
    ]
])->except('update');
Route::post('teacher/update/{id}','App\Http\Controllers\TeacherController@update')->name('teacher.update');


// course
Route::resource('courses', 'App\Http\Controllers\CourseController');
Route::resource('course', TeacherController::class,[
    'names' => [
        'index' => 'course',
        'store' => 'course.new',
        'destroy' => 'course.delete',
    ]
])->except('update');
Route::post('course/update/{id}','App\Http\Controllers\CourseController@update')->name('course.update');


// files
Route::prefix('files')->group(function () {
    // uploads
    Route::get('/uploads/{id}','App\Http\Controllers\TeacherController@myUploads')->name('upload')->middleware('teacher');
    Route::post('/upload','App\Http\Controllers\TeacherController@uploadFileSubmit')
        ->name('file.upload')->middleware('teacher');

    Route::post('/delete/{id}','App\Http\Controllers\TeacherController@deleteFile')
            ->name('file.delete')->middleware('teacher');

    // downloads
    Route::get('/list','App\Http\Controllers\StudentController@fileList')->name('files.list')->middleware('student');
    Route::get('/download/{file}', 'App\Http\Controllers\StudentController@download')->name('file.download');

});

Route::get('upload-files','App\Http\Controllers\TeacherController@uploadFile')->name('upload.file')->middleware('teacher');


Route::get('/messages','App\Http\Controllers\StudentController@messages')
->name('messages');


Route::post('/send/message','App\Http\Controllers\StudentController@sendMessage')
->name('send.message');


Route::get('/messages/teacher','App\Http\Controllers\TeacherController@messages')
->name('messages.teacher');
    Route::post('/teacher/send/message','App\Http\Controllers\TeacherController@sendMessage')
    ->name('teacher.send.message');


