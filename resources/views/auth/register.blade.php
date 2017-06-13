@extends('template.landing-template')
{{--@extends('layouts.app')--}}

@section('page-header')

    @include('components.page-header',[
        'header' => 'ลงทะเบียน'
    ])

@endsection

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('u_email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="u_email" type="email" class="form-control" name="u_email" value="{{ old('u_email') }}" required>

                                @if ($errors->has('u_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('u_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('u_username') ? ' has-error' : '' }}">
                            <label for="u_username" class="col-md-4 control-label">Username ( สำหรับ login )</label>

                            <div class="col-md-6">
                                <input id="u_username" type="text" class="form-control" name="u_username" value="{{ old('u_username') }}" required autofocus>

                                @if ($errors->has('u_username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('u_username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
