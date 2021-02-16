<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <style>
    .phpdebugbar{
        display: none;
      }
    .pb-7, .py-7 {
        padding-bottom: 1.75rem!important;
    }
    .pt-7, .py-7 {
        padding-top: 1.75rem!important;
    }
    p span {
        display: block;
      }

      .overlay{
        background-image: linear-gradient(180deg,rgba(0,0,0,0.2) 0%,#000000 100%),url({{ asset('img/south_african_rand1-922x614.jpg') }})!important;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        position: absolute;
        min-height: calc(100% - 0px);
        display: flex;
        place-items: center;
        margin-right: 0px;
        margin-left: 0px;
        right: 0px;
        left: 0px;
      }

      .form-control{
        background: #f3f6f9;
        border-radius: 0.4em;
        height: 45px
      }

</style>
</head>
<body>
        <div class="row overlay">

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 offset-md-3 col-lg-4 offset-lg-4">

                        <div class="container text-dark  justify-content-center " style="border-radius: 10px;background-color:white;">

                          <h3 class="text-left pt-3 pb-3">Login</h3>
                          <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                      <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" placeholder="Email *" name="email"
                                      value="{{ old('email') }}" required autofocus>

                                      @if ($errors->has('email'))
                                          <div class="invalid-feedback">
                                              <strong>{{ $errors->first('email') }}</strong>
                                          </div>
                                      @endif
                                  </div>

                                  <div class="form-group row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary pb-2" style="padding:10px;  width:100%; font-weight:500;">Login</button>
                                    </div>
                                  </div>

                                <div class="form-group row">
                                    <div class="col-12">
                                        <p><span>Already a member yet?</span><span><a href="{{ url('/login') }}">login</a></span></p>
                                    </div>
                                </div>

                          </form>
                        </div>
                    </div>
                </div>

              </div>
        </div>
</body>
</html>

