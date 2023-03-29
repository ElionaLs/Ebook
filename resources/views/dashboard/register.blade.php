@extends('layout_login')

@section('content')
	


	<section class="ftco-section">
		<div class="container">
			
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
		      	<h3 class="text-center mb-4">Register</h3>
				  <form method="POST" action="{{route('register.post')}}" class="login100-form validate-form">
					@csrf
					@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>   
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					</div>
             		@endif
		      		<div class="form-group">
		      			<input type="text" name="name" class="form-control rounded-left" placeholder="Name" required>
		      		</div>
					<div class="form-group d-flex">
						<input type="email" name="email" class="form-control rounded-left" placeholder="Email" required>
					</div>
					<div class="form-group d-flex">
						<input type="text" name="address" class="form-control rounded-left" placeholder="Address" required>
					</div>
					<div class="form-group d-flex">
						<input type="number" name="no_hp" class="form-control rounded-left" placeholder="Number" required>
					</div>
					<div class="form-group d-flex">
						<input type="password" name="password" class="form-control rounded-left" placeholder="Password" required>
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

	@endsection