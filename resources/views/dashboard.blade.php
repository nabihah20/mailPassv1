@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="jumbotron">
    <h2>Dashboard</h2>

    <a class="btn btn-info btn-lg" href="/typemail" role="button"><span class="glyphicon glyphicon-plus"></span> Compose Mail</a>
    <br/><br/>
    <h3>Sent Emails</h3>
    <br/><br/>
            @if (count($sent_emails) > 0)
            <table class="table table-striped">
                <tr>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                    @foreach($sent_emails as $sent_email)
                        <tr>
                            <td><a href="/mails/{{$sent_email->id}}/">{{$sent_email->subject}}</a></td>
                            <td>
                                Open {{$sent_email->opens}} times | Url Clicks {{$sent_email->clicks}} times | Last activity on {{$sent_email->updated_at}} by {{$sent_email->recipient}} 
                            </td>
                            <td>
                                {!!Form::open(['action'=>['MailsController@destroy',$sent_email->id],'method'=>'POST','class'=>'pull-center'])!!}
                                    {{Form::hidden('_method','DELETE')}}
                                    {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                {!! Form::close() !!}  
                            </td>
                        </tr>
                        @endforeach
            </table>
            @else
                <p>You have no sent mail</p>
            @endif  
        </div>

@endsection
