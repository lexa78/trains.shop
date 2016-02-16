@extends('public')

@section('content')
    <section id="content"><div class="ic"></div>
        <div class="sub-page">

            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                @endforeach
            </div>

            <div class="sub-page-left box-9">
                <h2 class="p4">Мои документы</h2>
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
            <div class="sub-page-right">
                Хуй знает, что тут ставить
            </div>
        </div>
    </section>
@stop