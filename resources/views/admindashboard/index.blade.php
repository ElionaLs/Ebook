@extends('layout-admin')

@section('admin')
    <!-- Page Wrapper -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @csrf
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>
                    @if(Session::get('successLogin'))
                    <br>
                    <div class="alert alert-success w-100">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{session('successLogin')}}
                    </div>
                    @endif
                    
                    <hr style="font-weight: bold">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Hi, {{Auth::user()->name}}!</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

@endsection