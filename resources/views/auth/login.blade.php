@extends('app')
@section('content')
<main class="login-form">
    <div class="cotainer ">
        <div class="row justify-content-center p-4">
            <div class="col-md-4 ">
                <div class="card">
                    <h3 class="card-header text-center">Login</h3>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login.custom') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email" id="email" class="form-control" name="email" required
                                    autofocus>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                             <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
                      <label for="password" class="col-md-4 control-label">Captcha</label>


                      <div class="form-group mb-3">
                          <div class="captcha">
                          <span>{!! captcha_img() !!}</span>
                          <button type="button" class="btn btn-success btn-refresh"><i class="fa fa-refresh"></i></button>
                          </div>
                          <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">


                          @if ($errors->has('captcha'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('captcha') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>

                            </div>
                            <div class='m-4 text-center'>
                                <b>If you are new user kindly register</b>

                                <button class='btn btn-success btn-block'>
                                    <a class="nav-link" href="{{ route('register-user') }}">Register</a>

                                </button>

                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <a href="{{ route('forget.password.get') }}">Reset Password</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript">


$(".btn-refresh").click(function(){
  $.ajax({
     type:'GET',
     url:'/refresh_captcha',
     success:function(data){
        $(".captcha span").html(data.captcha);
     }
  });
});


</script>
@endsection
