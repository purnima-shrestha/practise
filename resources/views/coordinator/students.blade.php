@extends('layouts.coordinatordashboard')
@section('content')
    <div class="page-wrapper">
        {{-- Bread crumb  --}}
        <div class="page-breadcrumb bg-white">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title text-uppercase font-medium font-14">Get Students</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <div class="d-md-flex">
                        <ol class="breadcrumb ml-auto">
                            <li><a href="#">Students</a></li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        {{-- Container --}}
        <div class="container-fluid">
            {{-- Start Page Content --}}
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                       
                      
                        {{-- table --}}
                        <h3 class="box-title">Student Table</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">#</th>
                                        <th class="border-top-0">Student Name</th>
                                        <th class="border-top-0">Email</th>
                                        <th class="border-top-0">Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($students->count())
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>{{ $loop->index+1}}</td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>{{ $student->role }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>            
        <footer class="footer text-center"> 2020 © Anish</footer>
    </div>
@endsection