@extends('layouts.app')

@section('title')
    Compose Mail
@endsection

@section('content')
    <h1>Choose the way to send email</h1>

    <div class="jumbotron text-center">
        <h2> Send email with Attachment </h2>
        <a class="btn btn-primary btn-lg" href="/encryptfile" role="button"><span class="glyphicon glyphicon-plus"></span>  Attachment with Encryption <span class="glyphicon glyphicon-link"></a>
        <a class="btn btn-primary btn-lg" href="/composemail" role="button"><span class="glyphicon glyphicon-plus"></span>  Attachment without Encryption <span class="glyphicon glyphicon-paperclip"></a>

    </div>
    <div class="jumbotron text-center">
        <h2> Send email without Attachment </h2>
        <a class="btn btn-info btn-lg" href="/composemessage" role="button"><span class="glyphicon glyphicon-plus"></span>  No Attachment </a>
    </div>
@endsection