@extends('layout-admin')

@section('admin')



<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
    </div>
    <form method="POST" action="{{route('updateuser', $user['id'])}}" style="width: 3000px">
        @csrf
        @method('PATCH')
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="col-md-5">
            <div class="card border-0">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-auto mt-0">
                            <p><b>Edit User</b></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="NAME" class="small text-muted mb-1">Name</label>
                        <input type="text" class="form-control form-control-sm" name="name" value="{{ $user['name'] }}"
                            aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="NAME" class="small text-muted mb-1">Email</label>
                        <input type="email" class="form-control form-control-sm" name="email"
                            value="{{ $user['email'] }}" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="NAME" class="small text-muted mb-1">Address</label>
                        <input type="text" class="form-control form-control-sm" name="address"
                            value="{{ $user['address'] }}" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="NAME" class="small text-muted mb-1">Password</label>
                        <input type="password" class="form-control form-control-sm" name="password"
                            value="{{ $user['password'] }}" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="NAME" class="small text-muted mb-1">Number</label>
                        <input type="number" class="form-control form-control-sm" name="no_hp"
                            value="{{ $user['no_hp'] }}" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                    <label for="exampleFormControlInput1">Roles</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="role">
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                    </div>
                    <div class="row mb-md-5 mt-3">
                        <div class="col">
                            <button type="submit" name="" id="" class="btn btn-primary ">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
