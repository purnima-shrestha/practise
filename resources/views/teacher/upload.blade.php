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


                         {{-- alert --}}
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <h3 class="box-title">{{$course->name}}</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">File Name</th>
                                            <th class="border-top-0">Upload Date</th>
                                            <th class="border-top-0">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    {{-- file listing --}}
                                    @foreach ($files as $file) 
                                        <tr>
                                            <td>{{$file->id}}</td>
                                            <td>{{$file->name}}</td>
                                            <td>{{$file->created_at}}</td>
                                            <td> 
                                                <div class="d-flex">
                                                    {{-- delete --}}
                                                    <form 
                                                        action="{{ route('file.delete',  $file->id) }}"
                                                         method="POST">
                                                        @csrf
                                                        <button class="btn delete-upload-file" type="submit"><i class="fa fa-trash text-danger" aria-hidden="true"></i></button>
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


<script type="text/javascript">
     $('.delete-upload-file').on('click', function (e) {
        e.preventDefault();
        swal({

          title: "Are you sure?",
          text: "You won't be able to revert this!!",
          icon: "warning",
          buttons: true,
          dangerMode: true,

        }).then((result) => {
            if (result) {
                  $(this).closest('form').submit();
                
                   swal(
                      'Deleted!',
                      'File has been deleted.',
                      'success'
                    )
            }
        })
    });
</script>

@endsection