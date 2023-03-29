@extends('layout-admin')

@section('admin')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Category</h1>
    </div>
    <form method="POST" action="{{route('store') }}" style="width: 3000px">
        @csrf
        <div class="col-md-5">
            <div class="card border-0">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-auto mt-0">
                            <p><b>Form Create Category</b></p>
                        </div>
                    </div>
                    @if (Session::get('successadd'))
                    <div class="alert alert-success w-100">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ Session::get('successadd') }}
                    </div>
                    @endif
                    @if (Session::get('categoryUpdate'))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ Session::get('categoryUpdate') }}
                    </div>
                    @endif
                    @if (Session::get('categoryDelete'))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ Session::get('categoryDelete') }}
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="NAME" class="small text-muted mb-1">Category Name</label>
                        <input type="text" class="form-control form-control-sm" name="category" id="NAME"
                            aria-describedby="helpId">
                    </div>
                    <div class="row mb-md-5">
                        <div class="col">
                            <button type="submit" name="" id="" class="btn btn-primary ">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th style="font-weight: bold">No</th>
                    <th style="font-weight: bold">ID</th>
                    <th style="font-weight: bold">Category Name</th>
                    <th style="font-weight: bold">Action</th>
                    <th style="font-weight: bold">Created_at</th>
                    <th style="font-weight: bold">Updated_at</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i = 1;
                ?>
                    @foreach ($kategori as $kategori)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$kategori->id}}</td>
                        <td>{{$kategori->category}}</td>
                        <th>{{ $kategori->created_at->format('y-m-d') }}</th>
                        <th>{{ $kategori->updated_at->format('y-m-d') }}</th>
                        <td>
                            <div class="ml-auto">
                                <form action="{{ route('deleteCategory', $kategori['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a class="fa-regular fa-pen-to-square text-dark"
                                        href="{{route('editCategory', $kategori['id'])}}"></a>
                                    <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this category?')"
                                        class="fa-regular fa-trash-can text-danger btn"></button>
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
