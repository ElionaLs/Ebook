@extends('layout-admin')

@section('admin')



<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Users</h1>
      <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-success btn-excel" href="{{ route('userExportExcel') }}">
          <i class="fa-solid fa-file-excel mr-1"></i> Excel
        </a>
        <a class="btn btn-danger btn-print ml-2" href="{{ route('userPrintable') }}" target="_blank">
          <i class="fa-solid fa-print mr-1"></i> Print
        </a>
      </div>
    </div>
    @if (Session::get('successUpdate'))
    <div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::get('successUpdate') }}
    </div>
    @endif
    @if (Session::get('successDelete'))
    <div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::get('successDelete') }}
    </div>
    @endif
    <div style="overflow-x: auto;">
      <table class="table">
          <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Address</th>
              <th>No Handphone</th>
              <th>Email</th>
              <th>Role</th>
              <th>Created_at</th>
              <th>Updated_at</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
                <?php
                  $i = 1;
                ?>
                @foreach ($users as $user)
                <tr>
                  <td>{{$i++}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->address}}</td>
                  <td>{{$user->no_hp}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->role}}</td>
                  <th>{{$user->created_at->format('y-m-d') }}</th>
                  <th>{{$user->updated_at->format('y-m-d') }}</th>
                  <td>
                    <div class="ml-auto">
                      <form action="{{ route('deleteuser', $user['id']) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <a class="fa-regular fa-pen-to-square text-dark" href="{{route('edituser', $user['id'])}}"></a>
                          <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')" class="fa-regular fa-trash-can text-danger btn"></button>
                      </form>
                    </div>
                  </td>
                </tr>
            </tbody>
            @endforeach
          </table>
    </div>
</div>

@endsection