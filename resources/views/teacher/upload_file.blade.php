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
                        <h4 class="page-title text-uppercase font-medium font-14">Upload Files</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ml-auto">
                                <li><a href="/">Upload Files</a></li>
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


                   
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-success">
                                    {{ $error }}
                                </div>
                        @endforeach
                    @endif



                    {{-- create  --}}
                        <div>
                            <p>
                                <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#collapseExample">
                                    <i class="fa fa-plus-circle"></i>
                                    Upload New File
                                </button>
                            </p>
                            <div class="collapse show" id="collapseExample">
                                <form action="{{ route('file.upload') }}" method="post"
                                     enctype="multipart/form-data">
                                    @csrf
                                        <div class="form-group">
                                            <input type="hidden" name="course_id" value="{{$course->id}}">
                                            <label for="lecturefile">Upload lecture file</label>
                                            <input type="file"  name ="file" class="form-control" id="lecturefile">
                                            <button class="btn btn-primary mt-2" type="submit" >
                                                Submit
                                            </button>
                                        </div>
                                        
                                </form>
                            </div>
                        </div>

                         {{-- alert --}}
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            
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
