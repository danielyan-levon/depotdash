@extends('admin.layouts.dashboard')
@section('content')
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Customers
            </header>
            <div class="panel-body">
                <div class="panel-body">
                    <section id="unseen">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Billing Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr class="">
                                    <td class="numeric">{{$user->name}}</td>
                                    <td class="numeric">{{$user->email}}</td>                                      
                                    <td class="numeric">{{$user->phone}}</td>                                      
                                    <td class="numeric">{{$user->billing_address}}</td>                                      
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </section>
                </div>                
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
@endsection
@section('scripts')

@endsection