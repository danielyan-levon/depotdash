@extends('spark::layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Choose passowrd</div>
                <div class="panel-body">
                    @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> Something went wrong!
                        <br><br>
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{route('post_customer_invitation')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name='verification_token' value="{{$token}}">
                        <!-- Password -->
                        <div class="form-group">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" value="" autofocus="">
                            </div>
                        </div>

                        <!-- Repeat Password -->
                        <div class="form-group">
                            <label class="col-md-4 control-label">Repeat Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>
                        <!-- Login Button -->
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa m-r-xs fa-sign-in"></i>Sign up
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection