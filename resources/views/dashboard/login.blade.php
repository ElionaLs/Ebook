@extends('layout_login')

@section('content')
<style>
    .input-group-text {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
    }

    .input-group-text i {
        font-size: 20px;
        cursor: pointer;
    }

    .position-relative input[type="password"] {
        padding-right: 45px !important;
    }

    .position-absolute {
        right: 0;
        top: 0;
        height: 100%;
        display: flex;
        align-items: center;
    }

</style>


<section class="ftco-section">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="login-wrap p-4 p-md-5">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-user-o"></span>
                    </div>
                    <h3 class="text-center mb-4">Sign In</h3>
                    <form method="POST" action="{{route('login.auth')}}" class="login100-form validate-form">
                        @csrf
                        @if(Session::get('notAllowed'))
                        <div class="alert alert-danger w-100">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{session('notAllowed')}}
                        </div>
                        @endif
                        @if (Session::get('success'))
                        <div class="alert alert-success w-100">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ Session::get('success') }}
                        </div>
                        @endif
                        @if (Session::get('successLogout'))
                        <div class="alert alert-success w-100">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ Session::get('successLogout') }}
                        </div>
                        @endif
                        @if (Session::get('fail'))
                        <div class="alert alert-danger w-100">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ Session::get('fail') }}
                        </div>
                        @endif
                        @if ($errors->any())
                        <div class="alert alert-danger w-100">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </div>
                        @endif
                        <div class="form-group">
                            <input type="email" name="email" class="form-control rounded-left" placeholder="Email"
                                required>
                        </div>
                        <div class="form-group position-relative">
                            <input type="password" name="password" class="form-control rounded-left pr-5"
                                placeholder="Password" required>
                            <span class="position-absolute top-0 right-0 h-100 pr-3">
                                <i id="togglePassword" class="fa fa-eye"></i>
                            </span>
                        </div>
                        <div class="form-group d-md-flex">
                            <div class="w-100">
                                <a href="/register">Register Here</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary rounded submit p-3 px-5">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var togglePassword = document.querySelector('#togglePassword');
    var password = document.querySelector('input[name="password"]');

    togglePassword.addEventListener('click', function (e) {
        var type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        togglePassword.classList.toggle('fa-eye-slash');
        togglePassword.classList.toggle('fa-eye');
    });

</script>

@endsection
