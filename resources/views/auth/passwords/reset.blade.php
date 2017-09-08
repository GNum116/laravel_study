@extends('layouts.default')

@section('title', '更新密码')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset">
      <div class="panel panel-default">
        <div class="panel-heading">更新密码</div>
        <div class="panel-body">
          @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
          @endif

          <form action="{{ route('password.request') }}" method="post">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
              <label for="email">邮箱地址：</label>
              <div>
                <input type="email" id="email" name="email" class="form-control" value="{{ $email OR old('email') }}" required autofocus></input>

                @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" >密码：</label>

              <div>
                <input type="password" name="password" id="password" class="form-control" required>

                @if ($errors->has('password'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
              <label for="password-confirm">确认密码：</label>

              <div>
                <input type="password" name="password_confirmation" id="password-confirm" class="form-control" required>

                @if ($errors->has('password_confirmation'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="class-group">
              <button type="submit" class="btn btn-primary">修改密码</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection