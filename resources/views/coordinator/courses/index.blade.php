@extends('layouts.coordinatordashboard')

@section('content')

       <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title text-uppercase font-medium font-14">Create Courses</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ml-auto">
                                <li><a href="#">Courses</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                        {{-- create  --}}
                        <div>
                            <p>
                                <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#collapseExample">
                                    <i class="fa fa-plus-circle"></i>
                                    Create
                                </button>
                            </p>
                            <div class="collapse" id="collapseExample">
                                <form action="{{ route('courses.store') }}" method="post">
                                    @csrf
                                    <div class="card card-body container shadow">
                                        <div class="row">
                                        <div class="col-sm col-md-6">
                                            <div class="form-group">
                                                <label for="course">Course Name</label>
                                                <input type="text" class="form-control" id="course" name="name" required placeholder="Enter Course Name">
                                            </div>
                                        </div>
                                        <div class="col-sm col-md-6">
                                            <div class="form-group">
                                                <label for="course">Teacher Name</label>
                                                <select class="form-control" aria-label="Default select example" name="teacher_id">
                                                    @foreach ($teachers as $teacher)
                                                      <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                            {{-- alert --}}
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif

                            <h3 class="box-title">Course Table</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Course Name</th>
                                            <th class="border-top-0">Teacher</th>
                                            <th class="border-top-0">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    {{-- listing --}}
                                    @foreach ($courses as $course)
                                        <tr>
                                            <td>{{ $course->id }}</td>
                                            <td>{{ $course->name }}</td>
                                            <td>{{$course->user->name}}</td>
                                            <td> 
                                                <div class="d-flex">
                                                    {{-- update modal trigger --}}
                                                    <button type="submit" class="btn bg-white border-white edit-course-btn" >
                                                        <i class="fas fa-edit text-primary" aria-hidden="true"></i>
                                                    </button>
                                                    {{-- delete --}}
                                                    <form action="{{ route('courses.destroy',  $course->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn delete-user" type="submit"><i class="fa fa-trash text-danger " aria-hidden="true"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- Update Modal -->
            <div id="editModalCourses" class="modal fade"  aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        {{-- title --}}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Course</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form id="updateCoordinatorForm" method="POST">
                          @csrf

                            <div class="modal-body">
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    {{-- name --}}
                                    <div class="mb-2">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" 
                                        class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                          placeholder="Enter Course Name" id="name" 
                                        value="{{ old('name') }}">
                                        @error('name')
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
            <footer class="footer text-center"> 2020 © Anish</footer>
        </div>
@endsection


@section('script')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        $(document).ready(function(){
            // on button click
            $('.edit-course-btn').on('click',function(){

                $('#editModalCourses').modal('show');

                $tr = $(this).closest('tr');

                // data cotains all td data from the colosed tr i.e selected row/tr
                var data = $tr.children('td').map(function(){
                    return $(this).text();
                }).get();


                $('#id').val(data[0]);
                $('#name').val(data[1]);

                $('#updateCoordinatorForm').on('submit',function(e){
                    e.preventDefault();
                    var id = $('#id').val();


                    $.ajax({
                        type:'POST',
                        url:"/course/update/"+id,
                        data:$('#updateCoordinatorForm').serialize(),
                        success:function(response){
                            
                            $('#editModalCourses').modal('hide');

                            var title = response.message

                            swal({
                              title: title,
                              icon: 'warning',
                              showCancelButton: true,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              confirmButtonText: 'Okay'
                            }).then((result) => {
                              if (result) {
                                 window.location.reload();
                              }
                            })

                        },
                        error:function(error){
                             // console.log(error.responseText);
                           var errorMessage ='' ;

                            var errors = $.parseJSON(error.responseText);
                            $.each(errors.errors, function (key, val) {
                                errorMessage = val + errorMessage;
                            });


                          swal({
                              icon: 'error',
                              title: 'Error...',
                              text: errorMessage,
                             
                            })
                        }
                    });
                })
            });


        });
    </script>

     <!-- delete coordinator -->
    @include('coordinator.partial.delete_script')
@endsection
