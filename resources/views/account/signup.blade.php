@section('title', 'Register')
@extends('layouts.main')
@section('css')
    <style>
        .form-container.sign-in-container.col-md-6 {
            margin: 0 auto;
        }

        div#from-wrapper {
            padding: 70px 0px;
        }

        input.log.submit-btn, a.btn.btn1 {
            background: transparent;
            border: 1px solid var(--blue-color);
            border-radius: 30px;
            padding: 10px 30px;
        }

        .form-group {
            margin-bottom: 10px;
        }
    </style>
@endsection
@section('content')
    <section class="main-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-heading for-israel">

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="account">
        <div class="container" id="from-wrapper">

            <div class="form-container sign-in-container col-md-6">
                <h1 class="mb-4">Signup</h1>
                <form class="loginForm" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <input type="text"
                                    class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    name="name" placeholder="Full name" required>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <input type="text"
                                    class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="email" placeholder="Email" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">

                                <!--  <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Email" required>-->

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <input type="password"
                                    class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" placeholder="Password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="Confirm Password" required>
                            </div>
                        </div>
                    </div>

                    <div class="row logRow">

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                            <div class="log submit-btn">
                                <!--<a href="javascript:void(0)" class="btn btn1"> Register </a> --> <input
                                    type="submit" class="log submit-btn" value="Register" /> </div>

                        </div>

                    </div>

                    <hr />


                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="customer">
                                <h5> Already have an account? <a href="{{ route('signin') }}" class=""> Login </a> </h5>
                            </div>
                        </div>
                    </div>


                </form>
            </div>

        </div>
    </section>
@endsection
@section('js')
    <script>
        $("#phone").on("keypress keyup blur", function(event) {
            $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
    </script>
@endsection
