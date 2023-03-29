@extends('layout-admin')

@section('admin')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Category</h1>
    </div>
    <form method="POST" action="{{route('updateCategory', $kategori['id'])}}" style="width: 3000px">
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
                            <p><b>Form Edit Category</b></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="NAME" class="small text-muted mb-1">Category Name</label>
                        <input type="text" class="form-control form-control-sm" name="category" id="NAME" value="{{ $kategori['category'] }}"
                            aria-describedby="helpId">
                    </div>
                    <div class="row mb-md-5">
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
