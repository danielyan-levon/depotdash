@extends('admin.layouts.plane')

@section('content')
<div class="container">
    <form class="form-signin" method="post" action="{{route('admin-login')}}">      
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <h2 class="form-signin-heading">sign in now</h2>
        <div class="login-wrap">
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
            <input type="text" name="email" class="form-control" placeholder="User ID" autofocus>
            <input type="password" name="password" class="form-control" placeholder="Password">
            <label class="checkbox">
                <input type="checkbox" value="remember"> Remember me               
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>           
        </div>       
    </form>
</div>
@endsection