@extends('layouts.app')

@section('title')
    Welcome
@endsection

@section('content')
    <div class="jumbotron text-center">
        <h1>Welcome To MailPass</h1>
        <img alt="Brand" src="img/logomailpass.png" height="150" width="auto"/>
        <p><a class="btn btn-primary btn-lg" href="/about" role="button"><span class="glyphicon glyphicon-log-in"></span>  Learn more</a>
        </p>
    </div>
@endsection