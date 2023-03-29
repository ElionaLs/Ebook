@extends('layout-admin')

@section('admin')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Book</h1>
    </div>
    <form method="POST" action="{{route('updateBook', $buku['id'])}}" style="width: 3000px" enctype="multipart/form-data">
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
                            <p><b>Form Create Book</b></p>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-sm-6 pr-sm-2">
                            <div class="form-group">
                                <label for="NAME" class="small text-muted mb-1">Title</label>
                                <input type="text" class="form-control form-control-sm" name="title" id="NAME" value="{{ $buku['title'] }}"
                                    aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="NAME" class="small text-muted mb-1">Writer</label>
                                <input type="text" class="form-control form-control-sm" name="writer" id="NAME" value="{{ $buku['writer'] }}"
                                    aria-describedby="helpId">
                            </div>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-sm-6 pr-sm-2">
                            <div class="form-group">
                                <label for="NAME" class="small text-muted mb-1">Publisher</label>
                                <input type="text" class="form-control form-control-sm" name="publisher" id="NAME" value="{{ $buku['publisher'] }}"
                                    aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="NAME" class="small text-muted mb-1">NO ISBN</label>
                                <input type="text" class="form-control form-control-sm" name="isbn" id="NAME" value="{{ $buku['isbn'] }}"
                                    aria-describedby="helpId">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Category Book</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="category"> 
                            @foreach($kategori as $kategori)
                                <option value="{{$kategori['category']}}" {{ $kategori['category'] == $buku['category'] ? 'selected' : '' }}>{{$kategori['category']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="NAME" class="small text-muted mb-1">Sinopsis</label>
                        <textarea class="form-control form-control-sm" name="synopsis" id="NAME" rows="3">{{ $buku['synopsis'] }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Book Cover</label>
                        <input class="form-control" type="file" id="formFile" name="cover" id="cover" 
                            accept=".jpg, .jpeg, .png" onchange="previewImage(event)">
                    </div>
                    <div class="mb-3" id="preview-container">
                        <label for="preview" class="form-label">Cover Sebelum Diedit</label>
                        <br>
                        <img id="preview" src="{{ asset('storage/images/books/'.$buku->cover) }}" alt="Cover preview" style="max-width: 200px; max-height: 300px;">
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