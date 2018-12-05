@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <div style="text-align: center;">
                        <a class="btn btn-primary btn-lg" href="/mails" role="button"><span class="glyphicon glyphicon-envelope"></span>  Inbox </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
