@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            {!! link_to_route('cabinet','Вернуться в личный кабинет', null, ['class'=>'btn btn-info']) !!}
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Мои документы</div>

                    <div class="panel-body">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                        @if(count($documentsByTypes))
                            @foreach($documentsByTypes as $type => $documents)
                                <h3>{{ $type }}</h3>
                                <table width="100%">
                                    <tr>
                                        <td>№ п/п</td>
                                        <td>Документ</td>
                                        <td>Скачать</td>
                                        <td>Посмотреть</td>
                                    </tr>
                                    @foreach($documents as $key=>$document)
                                        <tr>
                                            <td>{{  $key +1 }}</td>
                                            <? $shownFileName = $type.' № '. $document['orderNumber'];?>
                                            <td>{{ $shownFileName }} от {{ $document['fileDate'] }}</td>
                                            <td>
                                                {!! Form::open(['route' => 'downloadDoc', 'role' => 'form']) !!}

                                                {!! Form::hidden('shortFileName', $document['shortFileName']) !!}
                                                {!! Form::hidden('shownFileName', $shownFileName) !!}
                                                {!! Form::hidden('download', true) !!}

                                                {!! Form::submit('Скачать') !!}

                                                {!! Form::close() !!}
                                            </td>
                                            <td>
                                                {!! Form::open(['route' => 'downloadDoc', 'role' => 'form']) !!}

                                                {!! Form::hidden('shortFileName', $document['shortFileName']) !!}
                                                {!! Form::hidden('shownFileName', $shownFileName) !!}
                                                {!! Form::hidden('download', false) !!}

                                                {!! Form::submit('Посмотреть') !!}

                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @endforeach
                        @else
                            <b>Документов нет</b><br>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop