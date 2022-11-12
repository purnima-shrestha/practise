@extends('layouts.teacherdashboard')

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
                        <div id="editModalCourses" class="modal fade" role="dialog"    >
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    {{-- title --}}
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Send Message</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form action="{{route('teacher.send.message')}}" method="POST">
                                      @csrf

                                        <div class="modal-body">
                                            <input type="hidden" name="teacher_id" value="{{auth()->user()->id}}">
                                            <input type="hidden" id="student_id" name="student_id" value="">
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
                                                
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" id="save" class="btn btn-primary submit-edit">Submit</button>
                                        </div>
                                    </form>

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
                                    <th style="display: none;">id</th>
                                    <th class="border-top-0">Student Name</th>
                                    <th class="border-top-0">Title</th>
                                    <th class="border-top-0">Body</th>
                                    <th class="border-top-0">Sent At</th>
                                    <th class="border-top-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            {{-- file listing --}}
                            @foreach ($messages as $row) 
                                <tr>
                                    <td style="display: none;">{{$row->studentName->id}}</td>
                                    <td>{{$row->studentName->name}}</td>
                                    <td>{{$row->title}}</td>
                                    <td> 
                                        {{$row->body}}
                                    </td>
                                    <th>
                                        {{$row->created_at}}
                                    </th>
                                    <td>

                                          <button type="submit" class="btn bg-white border-white send-message" >
                                            <i class="fas fa-reply text-primary"></i>
                                          </button>
                                    </td>
                                </tr>
                            @endforeach 
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


@section('script')
    
   <script>
        $(document).ready(function(){
            // on button click
            $('.send-message').on('click',function(){

                                      
                $('#editModalCourses').modal('show');

                $tr = $(this).closest('tr');

                // data cotains all td data from the colosed tr i.e selected row/tr
                var data = $tr.children('td').map(function(){
                    return $(this).text();
                }).get();


                $('#student_id').val(data[0]);

               
            });


        });
    </script>

@endsection

