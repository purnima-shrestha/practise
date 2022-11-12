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
                        <h4 class="page-title text-uppercase font-medium font-14">Student Profile</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ml-auto">
                                <li><a href="/">Student Profile</a></li>
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

                    <div>
                        <p>
                            <button class="btn btn-primary" id="update-profile">
                                <i class="fa fa-plus-circle"></i>
                                Update Info
                            </button>
                        </p>
                    </div>
                    <div class="row">
                        {{-- name --}}
                        <div class="col-sm-3 col-md-2 col-5">
                            <label style="font-weight:bold;">Full Name</label>
                        </div>
                        <div class="col-md-8 col-6">
                        {{ $profile->name }}
                        </div>
                    </div>
                        <hr />
                        {{-- email --}}
                    <div class="row">
                        <div class="col-sm-3 col-md-2 col-5">
                            <label style="font-weight:bold;">Email</label>
                        </div>
                        <div class="col-md-8 col-6">
                            {{ $profile->email }}
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        {{-- role --}}
                        <div class="col-sm-3 col-md-2 col-5">
                            <label style="font-weight:bold;">Role</label>
                        </div>
                        <div class="col-md-8 col-6">
                        {{ $profile->role }}
                        </div>
                    </div>
                        <hr />
                        {{-- created at --}}
                    <div class="row">
                        <div class="col-sm-3 col-md-2 col-5">
                            <label style="font-weight:bold;">Created At</label>
                        </div>
                        <div class="col-md-8 col-6">
                            {{ $profile->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>

                 <!-- Update Modal -->
                <div id="editModalStudent" class="modal fade"  aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            {{-- title --}}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Student Info</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form id="updateStudentForm" method="POST">
                              @csrf

                                <div class="modal-body">
                                    <input type="hidden" name="id" id="id">
                                    <div class="form-group">
                                        {{-- name --}}
                                        <div class="mb-2">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" 
                                            class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                             required placeholder="Enter Teacher Name" id="name" 
                                            value="{{ old('name') }}">
                                            @error('name')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- email --}}
                                        <div class="mb-2">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" 
                                            class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" required placeholder="Enter Teacher Email" id="email"
                                            value="{{ old('email') }}">
                                            @error('email')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- password --}}
                                        <div class="mb-2">
                                            <label for="password">New Password</label>
                                            <input type="password" name="password" class="form-control password"  placeholder="Enter Teacher Password" id="password">
                                            @error('password')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- confirm password --}}
                                        <div class="mb-2">
                                            <label for="password_confirmation">Repeat New Password</label>
                                            <input type="password" name="password_confirmation" 
                                            class="form-control"  
                                            placeholder="Enter Teacher Password"
                                            id="password_confirmation">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    {{-- submit update --}}
                                        <button id="save" class="btn btn-primary submit-edit">Save changes</button>
                                </div>
                            </form>

                        </div>
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


@section('script')

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        $(document).ready(function(){
            // on button click
            $('#update-profile').on('click',function(){

                $('#editModalStudent').modal('show');

                var data = [];
                data[0] = {{\Auth::user()->id}};
                data[1] = "{{\Auth::user()->name}}";
                data[2] = "{{\Auth::user()->email}}";
                $('#id').val(data[0]);
                $('#name').val(data[1]);
                $('#email').val(data[2]);

                $('#updateStudentForm').on('submit',function(e){
                    e.preventDefault();
                    var id = $('#id').val();

                    $.ajax({
                        type:'POST',
                        url:"/student/update/"+id,
                        data:$('#updateStudentForm').serialize(),
                        success:function(response){
                            
                            $('#editModalStudent').modal('hide');

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
                });
            })

        });
    </script>

@endsection