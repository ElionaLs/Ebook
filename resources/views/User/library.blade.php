  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Document</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <style>
          .icon-hover:hover {
              border-color: #3b71ca !important;
              background-color: white !important;
          }

          .icon-hover:hover i {
              color: #3b71ca !important;
          }

          nav.navbar {
              position: fixed;
              top: 0;
              width: 100%;
              z-index: 9999;
          }

          .dropdown-menu {
              max-height: 300px;
              overflow-y: auto;
          }

          .card {
              box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1);
          }

      </style>


  </head>

  <body>
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
          <div class="container">
              <a class="navbar-brand" href="/">Wikbook</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                  aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav">
                      <!-- Dropdown -->
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                              data-bs-toggle="dropdown" aria-expanded="false">
                              Category book
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"
                              style="max-height: 200px; overflow-y: auto;">
                              <li>
                                  <a class="dropdown-item" href="{{ route('books.category', 'all') }}">All</a>
                              </li>
                              @foreach($kategori as $category)
                              <li>
                                  <a class="dropdown-item"
                                      href="{{ route('books.category', $category->category) }}">{{$category->category}}</a>
                              </li>
                              @endforeach
                          </ul>
                      </li>
                  </ul>
                  <ul class="navbar-nav ms-auto ml-auto">
                      <!-- tambahkan kelas ml-auto pada ul -->
                      <li class="nav-item">
                          @if(Auth::check())
                          <a class="btn btn-outline-light me-2">Hi! {{Auth::User()->name}}</a>
                          @endif
                      </li>
                  </ul>
              </div>
          </div>
      </nav>




      <!--Main Navigation-->
      <header>


          <!-- Navbar -->
          <!-- Jumbotron -->
          <div class="bg-primary text-white py-5">
              <div class="container py-5">
                  <h1>
                      Top #3 books in weeks<br />
                      in our library
                  </h1>
                  <p>
                      Trendy books, Excellent plot
                  </p>
              </div>
          </div>
          <!-- Jumbotron -->
      </header>
      <!-- Products -->
      <section>
          <div class="container my-5">
              <header class="mb-4">
                  <h3>Books List</h3>
              </header>

              <div class="row">
                  @foreach($buku as $book)
                  <div class="col-lg-3 col-md-6 col-sm-6 d-flex">
                      <div class="card w-100 my-2 shadow-2-strong" style="max-width: 250px">
                          <img src="{{ asset('storage/images/books/'.$book->cover) }}"
                              class="card-img-top img-fluid rounded"
                              style="width: 250px; height: 270px; border-radius: 5px;" alt="...">
                          <div class="card-body d-flex flex-column">
                              <h6 class="card-title">Title : {{$book->title}}</h6>
                              <p class="card-text">Writer : {{$book->writer}}</p>
                              <p class="card-text">Category : {{$book->category}}</p>
                              <button type="button" class="btn btn-primary mt-auto" data-bs-toggle="modal"
                                  data-bs-target="#exampleModalToggle{{ $book->id }}">Read More</button>
                          </div>
                      </div>
                  </div>

                  {{-- Modal --}}
                  <div class="modal fade" id="exampleModalToggle{{ $book->id }}" aria-hidden="true"
                      aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                      <div class="modal-dialog modal-xl modal-dialog-centered">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalToggleLabel">Book Detail</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                  <div class="row">
                                      <div class="col-md-3">
                                          <img src="{{ asset('storage/images/books/'.$book->cover) }}"
                                              class="card-img-top img-fluid rounded"
                                              style="width: 250px; height: 270px; border-radius: 5px;" alt="...">
                                      </div>
                                      <div class="col-md-8">
                                          <p><strong>Title :</strong> {{ $book->title }}</p>
                                          <p><strong>Writer :</strong> {{ $book->writer }}</p>
                                          <p><strong>Category :</strong> {{ $book->category }}</p>
                                          <p><strong>Publisher :</strong> {{ $book->publisher }}</p>
                                          <p><strong>NO ISBN :</strong> {{ $book->isbn }}</p>
                                          <hr>
                                          <p><strong>Synopsis : <br></strong> {{ $book->synopsis }}</p>
                                          <div class="ml-auto">
                                              <button class="btn btn-warning">Download E-book</button>
                                              <a href="/library" class="btn btn-danger">Back</a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  @endforeach
              </div>
          </div>
      </section>
      <!-- Products -->

      <!-- Feature -->


      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
          integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
      </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
          integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
      </script>

  </body>

  </html>
