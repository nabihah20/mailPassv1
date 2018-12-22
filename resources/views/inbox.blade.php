@extends('layouts.app')

@section('title')
    Inbox
@endsection

@section('content')
<div class="jumbotron">
    <h2>Dashboard</h2>
    <a class="btn btn-info btn-lg" href="/composemail" role="button"><span class="glyphicon glyphicon-plus"></span>  Compose </a>
    <a class="btn btn-success btn-lg" href="/dashboard" role="button"><i class="fa fa-envelope-open"></i>  Sent Mails </a>
    <br/><br/>
            @if (count($mails) > 0)
            <table class="table table-striped">
                <tr>
                    <th>Subject</th>
                    <th>Action</th>
                </tr>
                    @foreach($mails as $mail)
                        <tr>
                            <td><a href="/mails/{{$mail->id}}/">{{$mail->subject}}</a></td>
                            <td>
                                {!!Form::open(['action'=>['MailsController@destroy',$mail->id],'method'=>'POST','class'=>'pull-center'])!!}
                                    {{Form::hidden('_method','DELETE')}}
                                    {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                {!! Form::close() !!}  
                            </td>
                        </tr>
                        @endforeach
            </table>
            @else
                <p>You have no receive mail</p>
            @endif  
        </div>

@endsection
