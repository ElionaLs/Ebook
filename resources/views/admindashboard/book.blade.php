@extends('layout-admin')

@section('admin')

<div class="container-fluid">
    
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Books</h1>
        <div class="d-flex justify-content-end mb-3">
            <a class="btn btn-success btn-excel ml-2" href="{{ route('bookExportExcel') }}">
                <i class="fa-solid fa-file-excel mr-1"></i> Excel
            </a>
            <a class="btn btn-danger btn-print ml-2" href="" target="_blank">
                <i class="fa-solid fa-print mr-1"></i> Print
            </a>
            <a class="btn btn-primary btn-excel ml-2" href="/createBook">
                <i class="fa-regular fa-plus mr-1"></i> Create New
            </a>
        </div>
    </div>
    @if(Session::get('uploadBuku'))
    <br>
    <div class="alert alert-success w-100">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{session('uploadBuku')}}
    </div>
    @endif
    @if(Session::get('bookUpdate'))
    <br>
    <div class="alert alert-success w-100">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{session('bookUpdate')}}
    </div>
    @endif
    @if(Session::get('bookDelete'))
    <br>
    <div class="alert alert-success w-100">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{session('bookDelete')}}
    </div>
    @endif

    <div class="table-responsive">
        <!-- tambahkan kelas ini -->
        <table class="table table-bordered">
            <thead>
                <tr style="text-align: center">
                    <th scope="col">No</th>
                    <th scope="col">Book Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Writer</th>
                    <th scope="col">Category</th>
                    <th scope="col">Publisher</th>
                    <th scope="col">NO ISBN</th>
                    <th scope="col">Synopsis</th>
                    <th scope="col">Cover Book</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($buku as $data)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $data->id }}</td>
                    <td style="max-width: 150px;">{{ $data->title }}</td>
                    <td>{{ $data->writer }}</td>
                    <td>{{ $data->category }}</td>
                    <td style="max-width: 100px;">{{ $data->publisher }}</td>
                    <td>{{ $data->isbn }}</td>
                    <td style="max-width: 260px;">{{ substr($data->synopsis, 0, 372) . '...' }}</td>
                    <td style="max-width: 260px;"><img src="{{ asset('storage/images/books/'. $data->cover) }}" style="width: 170px; height: 200px;" alt="image"></td>
                    <td>
                        <div class="d-flex align-items-center justify-content-end">
                            <form action="{{ route('deleteBook', $data->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a class="fa-regular fa-pen-to-square text-dark" href="{{ route('editBook', $data->id) }}"></a>
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this book?')" class="fa-regular fa-trash-can text-danger btn"></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection
