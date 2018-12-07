@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="jumbotron">
    <h2>Dashboard</h2>
    <a class="btn btn-primary btn-lg" href="/composemail" role="button"><span class="glyphicon glyphicon-plus"></span>  Compose </a>
    <br/><br/>
            @if (count($mails) > 0)
            <table class="table table-striped">
                <tr>
                    <th>Subject</th>
                    <th></th>
                    <th>Action</th>
                </tr>
                    @foreach($mails as $mail)
                        <tr>
                            <td><a href="/mails/{{$mail->id}}/">{{$mail->subject}}</a></td>
                            <td></td>
                            <td>
                                {!!Form::open(['action'=>['MailsController@destroy',$mail->id],'method'=>'POST','class'=>'pull-left'])!!}
                                    {{Form::hidden('_method','DELETE')}}
                                    {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                {!! Form::close() !!}  
                            </td>
                        </tr>
                    @endforeach
            </table>
            @else
                <p>You have no mail</p>
            @endif  
        </div>

@endsection
