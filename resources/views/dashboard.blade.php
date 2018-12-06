@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div style="text-align: center;">
                        <a class="btn btn-primary btn-lg" href="/mails" role="button"><span class="glyphicon glyphicon-envelope"></span>  Inbox </a>
                    </div>
                    <div>
                        @if (count($mails) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                                @foreach($mails as $mail)
                                    <tr>
                                        <th>{{$mail->message}}</th>
                                        <th><a href="/mails/{{$mail->id}}/" class="btn btn-default">View</th>
                                        <th></th>
                                    </tr>
                                @endforeach
                        </table>
                        @else
                            <p>You have no mail</p>
                        @endif  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
