@extends('layouts.studentdashboard')

@section('content')

        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title text-uppercase font-medium font-14">My Messages</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ml-auto">
                                <li><a href="/">Messsage</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid mt-4">
                <!-- ============================================================== -->
                <div class="container bg-white p-4 shadow">

                     @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                             @if (session('error_message'))
                                <div class="alert alert-danger">
                                    {{ session('error_message') }}
                                </div>
                            @endif

                    <!-- send message modal -->
                    <div>
                            <p>
                                <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#editModalCourses">
                                    <i class="fa fa-plus-circle"></i>
                                    Send Message
                                </button>
                            </p>
                            

                            <!-- Update Modal -->
                            <div class="modal fade" id="editModalCourses"  role="dialog"    aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        {{-- title --}}
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Send Message</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="{{route('send.message')}}" method="POST">
                                          @csrf

                                            <div class="modal-body">
                                                <input type="hidden" name="student_id" value="{{auth()->user()->id}}">
                                                <div class="form-group">
                                                    {{-- name --}}
                                                    <div class="mb-2">
                                                        <label for="title">Title</label>
                                                        <input type="text" name="title" 
                                                        class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"
                                                          placeholder="Enter Title" id="title" 
                                                        value="{{ old('title') }}">
                                                        @error('title')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="title">Body</label>
                                                        
                                                        <textarea class="form-control {{ $errors->has('body') ? ' is-invalid' : '' }}" placeholder="Your Message" 
                                                         name="body" rows="3">{{old('body')}}</textarea>
                                                        @error('body')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    {{-- teacher --}}
                                                    <div class="mb-2">
                                                        <label for="email">Teacher</label>
                                                        <select class="form-control" aria-label="Default select example" name="teacher_id" id="teacher_id">
                                                            @foreach ($teachers as $teacher)
                                                                <option value="{{$teacher->id}}" >{{$teacher->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('teacher')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" id="save" class="btn btn-primary submit-edit">Save changes</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                    </div>
                    <!-- send message modal end -->


                    <!-- Table -->
                    <h3 class="box-title">Message Conversation</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Teacher Name</th>
                                    <th class="border-top-0">Title</th>
                                    <th class="border-top-0">Body</th>
                                    <th class="border-top-0">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            {{-- file listing --}}
                            @if(count($messages)>1))
                            @foreach ($messages as $row) 
                                <tr>
                                    <td>{{$row->teacherName->name}}</td>
                                    <td>{{$row->title}}</td>
                                    <td> 
                                        {{$row->body}}
                                    </td>
                                    <td>{{$row->created_at}}</td>
                                </tr>
                            @endforeach 
                            @else
                            <tr>
                                <td>
                                    No Messages
                                </td>                                
                            </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center"> 2020 © Anish</footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
@endsection
