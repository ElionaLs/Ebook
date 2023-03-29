@extends('layout-admin')

@section('admin')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Book</h1>
        <div class="d-flex justify-content-end mb-3">
            <a class="btn btn-primary btn-excel" href="/book">
              <i class="fa-solid fa-arrow-left mr-1"></i> Back
            </a>
        </div>
    </div>
    <form method="POST" action="{{route('bookstore') }}" style="width: 3000px" enctype="multipart/form-data">
        @csrf
        @if (Session::get('uploadBuku'))
        <div class="alert alert-success w-100">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('uploadBuku') }}
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
                                <input type="text" class="form-control form-control-sm" name="title" id="NAME" 
                                    aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="NAME" class="small text-muted mb-1">Writer</label>
                                <input type="text" class="form-control form-control-sm" name="writer" id="NAME"
                                    aria-describedby="helpId">
                            </div>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-sm-6 pr-sm-2">
                            <div class="form-group">
                                <label for="NAME" class="small text-muted mb-1">Publisher</label>
                                <input type="text" class="form-control form-control-sm" name="publisher" id="NAME"
                                    aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="NAME" class="small text-muted mb-1">NO ISBN</label>
                                <input type="text" class="form-control form-control-sm" name="isbn" id="NAME"
                                    aria-describedby="helpId">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Category Book</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="category">
                            @foreach($kategori as $kategori)
                            <option value="{{$kategori['category']}}">{{$kategori['category']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="NAME" class="small text-muted mb-1">Sinopsis</label>
                        <textarea class="form-control form-control-sm" name="synopsis" id="NAME" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Book Cover</label>
                        <input class="form-control" type="file" id="formFile" name="cover" id="cover"
                             onchange="previewImage(event)">
                    </div>
                    <div class="mb-3" style="display: none;" id="preview-container">
                        <label for="preview" class="form-label">Cover Preview</label>
                        <br>
                        <img id="preview" src="#" alt="Cover preview" style="max-width: 200px; max-height: 300px;">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Book PDF</label>
                        <input class="form-control" type="file" id="formFile" name="pdf" onchange="previewPdf(event)">
                    </div>
                    <div class="mb-3" style="display: none;" id="pdf-preview-container">
                        <label for="preview" class="form-label">PDF Preview</label>
                        <br>
                        <p id="pdf-preview-name"></p>
                        <a id="pdf-preview-link" target="_blank"></a>
                    </div>


                    <script>
                        function previewImage(event) {
                            var input = event.target;
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    var preview = document.getElementById("preview");
                                    preview.src = e.target.result;
                                    document.getElementById("preview-container").style.display = "block";
                                }
                                reader.readAsDataURL(input.files[0]);
                            }
                        }

                        function previewPdf(event) {
                            var input = event.target;
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    var preview = document.getElementById("pdf-preview");
                                    var previewContainer = document.getElementById("pdf-preview-container");
                                    var fileName = input.files[0].name;
                                    var link = document.createElement("a");
                                    var text = document.createTextNode(fileName);
                                    link.appendChild(text);
                                    link.href = e.target.result;
                                    previewContainer.style.display = "block";
                                    previewContainer.innerHTML = "";
                                    previewContainer.appendChild(link);
                                }
                                reader.readAsDataURL(input.files[0]);
                            }
                        }
                    </script>
                    <div class="row mb-md-5">
                        <div class="col">
                            <button type="submit" name="" id="" class="btn btn-primary ">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection