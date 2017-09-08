@extends('layouts.default')

@section('title', '重置密码')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset">
      <div class="panel panel-default">
        <div class="panel-heading">重置密码</div>
        <div class="panel-body">
          @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
          @endif
          <form action="{{ route('password.email') }}" method="post">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="control-label">邮箱地址：</label>

              <div>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">发送密码重置邮件</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection