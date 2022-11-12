@extends('layouts.studentdashboard')

@section('style')
<style type="text/css">
    input[type=checkbox] {
        transform: scale(1.5);
        -ms-transform: scale(1.5);
        -webkit-transform: scale(1.5);
    }
    .form-check-label {
        margin-bottom: 0;
        font-size: 15px;
    }
</style>
@endsection

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
                        <h4 class="page-title text-uppercase font-medium font-14">Choose Course</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            
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
                    <section class="container">

                        @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                                <strong>{{ $message }}</strong>
                        </div>
                        @endif

                        

                    <div class="row mb-3">
                        <h3>Choose Course</h3>
                    </div>

                    <form method="post" action="{{route('choose.course.submit',auth()->user()->id)}}">
                        @csrf
                        @foreach($selectedCourses as $course)

                        <div class="row">
                            <div class="form-check">

                              <input class="form-check-input" type="checkbox" value="{{$course->id}}" id="flexCheckDefault-{{$course->id}}" name="course[]"  checked="checked">

                              <label class="form-check-label" for="flexCheckDefault-{{$course->id}}">
                                {{$course->name}}
                              </label>

                            </div>
                        </div>
                        <hr>

                        @endforeach
                        @foreach($courses as $course)

                        <div class="row">
                            <div class="form-check">

                              <input class="form-check-input" type="checkbox" value="{{$course->id}}" id="flexCheckDefault-{{$course->id}}" name="course[]"  >

                              <label class="form-check-label" for="flexCheckDefault-{{$course->id}}">
                                {{$course->name}}
                              </label>

                            </div>
                        </div>
                        <hr>

                        @endforeach

                        <div class="row form-group mt-3">
                           <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                    </section>

                    
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
   

@endsection