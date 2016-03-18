@extends('landing')

@section('content')

		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<div class="">
      <a class="hiddenanchor" id="toregister"></a>
      <a class="hiddenanchor" id="tologin"></a>

      <div id="wrapper">
          <div id="login" class="animate form">
              <section class="login_content">
								<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <h1>Login Form</h1>
                      <div>
                          <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}"/>
                      </div>
                      <div>
                          <input type="password" name="password" class="form-control" placeholder="Password" required/>
                      </div>
                      <div>
													<label>
														<input type="checkbox" name="remember"> Remember Me
													</label>
                      </div>
                      <div>
                          <input type="submit" class="btn btn-default	" value="Login"/>
                          <a class="reset_pass" href="#">Lost your password?</a>
                      </div>
                      <div class="clearfix"></div>
                      <div class="separator">

                          <p class="change_link">New to site?
                              <a href="#toregister" class="to_register"> Create Account </a>
                          </p>
                          <div class="clearfix"></div>
                          <br>
                          <div>
                              <h1><i class="fa fa-headphone" style="font-size: 26px;"></i> Podcast Indonesia</h1>

                              <p>©2015 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                          </div>
                      </div>
                  </form>
                  <!-- form -->
              </section>
              <!-- content -->
          </div>
          <div id="register" class="animate form">
              <section class="login_content">
                  <form>
                      <h1>Create Account</h1>
                      <div>
                          <input type="text" class="form-control" placeholder="Username" required="">
                      </div>
                      <div>
                          <input type="email" class="form-control" placeholder="Email" required="">
                      </div>
                      <div>
                          <input type="password" class="form-control" placeholder="Password" required="">
                      </div>
                      <div>
                          <a class="btn btn-default submit" href="index.html">Submit</a>
                      </div>
                      <div class="clearfix"></div>
                      <div class="separator">

                          <p class="change_link">Already a member ?
                              <a href="#tologin" class="to_register"> Log in </a>
                          </p>
                          <div class="clearfix"></div>
                          <br>
                          <div>
                              <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Gentelella Alela!</h1>

                              <p>©2015 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                          </div>
                      </div>
                  </form>
                  <!-- form -->
              </section>
              <!-- content -->
          </div>
      </div>
  </div>

@endsection
