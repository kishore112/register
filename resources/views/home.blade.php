@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>

                <div class="table-responsive">
        <table border="1" class="table" style="align:center;">
        @foreach($users as $user)
        <tr><th>Name</th>
            <th>Email</th></tr>
        <tr> 
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td></tr>
            @endforeach
</table>
</div>
            </div>
        </div>
    </div>
</div>
@endsection
