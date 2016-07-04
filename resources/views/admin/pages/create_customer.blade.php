@extends('admin.layouts.dashboard')
@section('content')
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->             
        <div class="row">
            <div class="col-lg-6">
                <section class="panel">
                    <header class="panel-heading">
                        Add Customer
                    </header>
                    <div class="panel-body">
                        {!! Form::Open(array('route' => 'admin.customer.store')) !!}   
                        <div class="form-group">
                            {!! Form::label('name', 'Name:') !!}
                            {!! Form::text('name',null,array('class'=>'form-control')) !!}
                            <div style='color:red'>
                                {!!$errors->first('name')!!}
                            </div>                            
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'Email:') !!}
                            {!! Form::text('email',null,array('class'=>'form-control')) !!}
                            <div style='color:red'>
                                {!!$errors->first('name')!!}
                            </div>             
                        </div>                        
                        {!! Form::submit('Create',array('class'=>'btn btn-info')) !!}
                        {!! Form::close() !!}
                    </div>
                </section>
            </div>           
        </div>
        <!-- page end-->
    </section>
</section>

@endsection
@section('scripts')

@endsection