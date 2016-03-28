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
                <h2 class="p4">Создание нового пароля</h2>
                <p>Введите свой email и новый пароль.</p>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label class="col-md-4 control-label">Ваш E-Mail</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Новый пароль</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Подтверждение пароля</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="button">
                                Изменить пароль
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@stop
