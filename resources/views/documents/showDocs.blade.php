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
                                    <td>
                                        @if($document['orderNumber'])
                                            {{ $type.' № '. $document['orderNumber'] }}, от {{ $document['fileDate'] }}
                                        @else
                                            {{ $type.$document['tempNumber'] }}, от {{ $document['fileDate'] }}
                                        @endif
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => 'downloadDoc', 'role' => 'form', 'class'=>'inlineForm']) !!}
                                        {!! Form::hidden('shortFileName', $document['shortFileName']) !!}
                                        {!! Form::hidden('shownFileName', $document['shownFileName']) !!}
                                        {!! Form::hidden('download', true) !!}
                                        {!! Form::submit('Скачать', ['class'=>'button']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => 'downloadDoc', 'role' => 'form', 'class'=>'inlineForm']) !!}
                                        {!! Form::hidden('shortFileName', $document['shortFileName']) !!}
                                        {!! Form::hidden('shownFileName', $document['shownFileName']) !!}
                                        {!! Form::hidden('download', false) !!}
                                        {!! Form::hidden('content', $document['extension']) !!}
                                        {!! Form::submit('Посмотреть', ['class'=>'button-2 myBg']) !!}
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
    </section>
@stop