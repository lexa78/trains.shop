@extends('public')

@section('content')
    <section id="content"><div class="ic"></div>
        <div class="sub-page">
            <div class="flash-message">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Ошибка!</strong> Проверьте корректность введенных данных.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="sub-page-left box-9">
                @if ( ! session('status'))
                <h2 class="p4">Сброс пароля</h2>
                <p>На указанный email будет отправлено письмо с дальнейшими инструкциями.</p>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label class="col-md-4 control-label">Ваш E-Mail</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="button">
                                Отправить
                            </button>
                        </div>
                    </div>
                </form>
                @else
                    <a class="button" href="{{ url('/password/email') }}">Назад</a>
                @endif
            </div>
        </div>
    </section>
@stop
