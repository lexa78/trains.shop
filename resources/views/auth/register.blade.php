@extends('public')

@section('content')

    <section id="content"><div class="ic"></div>
        <div class="sub-page">
            <div class="sub-page-left box-9">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Ваши ФИО</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Петров Всеволод Станиславович">
                                            <p>допускается вводить только буквы</p>
                                            @if($errors->has('name'))
                                                <div class="alert-danger alert">{!! $errors->first('name') !!}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">E-Mail</label>
                                        <div class="col-md-6">
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="vsevolod@mail.ru">
                                            <p>допускается вводить только корректный адрес электронный почты</p>
                                            @if($errors->has('email'))
                                                <div class="alert-danger alert">{!! $errors->first('email') !!}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Пароль</label>
                                        <div class="col-md-6">
                                            <input type="password" class="form-control" name="password" placeholder="kdEjf7V8">
                                            <p>пароль должен состоять не менее, чем из 8 символов, допускаются буквы и цифры</p>
                                            @if($errors->has('password'))
                                                <div class="alert-danger alert">{!! $errors->first('password') !!}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Подтверждение пароля</label>
                                        <div class="col-md-6">
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="kdEjf7V8">
                                            <p>введенное значение должно полностью совпадать со значением, введенным выше</p>
                                            @if($errors->has('password_confirmation'))
                                                <div class="alert-danger alert">{!! $errors->first('password_confirmation') !!}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Полное наименование организации</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" value="{{ old('full_organisation_name') }}" name="full_organisation_name" placeholder="Общество с ограниченной ответственностью Вагоностроитель">
                                            <p>допускается вводить буквы, цифры и пробел</p>
                                            @if($errors->has('full_organisation_name'))
                                                <div class="alert-danger alert">{!! $errors->first('full_organisation_name') !!}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Краткое наименование организации</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="organisation_name" value="{{ old('organisation_name') }}" placeholder="ООО Вагоностроитель">
                                            <p>допускается вводить буквы, цифры и пробел</p>
                                            @if($errors->has('organisation_name'))
                                                <div class="alert-danger alert">{!! $errors->first('organisation_name') !!}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">ОКПО</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="okpo" value="{{ old('okpo') }}" placeholder="5861485312">
                                            <p>допускается вводить только цифры (10 цифр)</p>
                                            @if($errors->has('okpo'))
                                                <div class="alert-danger alert">{!! $errors->first('okpo') !!}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">ОГРН</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="ogrn" value="{{ old('ogrn') }}" placeholder="8546751359742">
                                            <p>допускается вводить только цифры (13 цифр)</p>
                                            @if($errors->has('ogrn'))
                                                <div class="alert-danger alert">{!! $errors->first('ogrn') !!}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">ИНН</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="inn" value="{{ old('inn') }}" placeholder="4746595421349">
                                            <p>допускается вводить только цифры (10 цифр)</p>
                                            @if($errors->has('inn'))
                                                <div class="alert-danger alert">{!! $errors->first('inn') !!}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">КПП</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="kpp" value="{{ old('kpp') }}" placeholder="697201001">
                                            <p>допускается вводить только цифры (9 цифр)</p>
                                            @if($errors->has('kpp'))
                                                <div class="alert-danger alert">{!! $errors->first('kpp') !!}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Номер расчетного счета</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="rs" value="{{ old('rs') }}" placeholder="2574686480000000127">
                                            <p>допускается вводить только цифры (20 цифр)</p>
                                            @if($errors->has('rs'))
                                                <div class="alert-danger alert">{!! $errors->first('rs') !!}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">БИК банка</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="bik" value="{{ old('bik') }}" placeholder="421658437">
                                            <p>допускается вводить только цифры (9 цифр)</p>
                                            @if($errors->has('bik'))
                                                <div class="alert-danger alert">{!! $errors->first('bik') !!}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Наименование банка</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="bank" value="{{ old('bank') }}" placeholder="ЗАО КИВИ Банк">
                                            <p>допускается вводить буквы, цифры, пробел и точку</p>
                                            @if($errors->has('bank'))
                                                <div class="alert-danger alert">{!! $errors->first('bank') !!}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Коррсчет банка</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="ks" value="{{ old('ks') }}" placeholder="48561214804957431579">
                                            <p>допускается вводить только цифры (20 цифр)</p>
                                            @if($errors->has('ks'))
                                                <div class="alert-danger alert">{!! $errors->first('ks') !!}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Должность ответственного лица</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="face_position" value="{{ old('face_position') }}" placeholder="Директор">
                                            <p>допускается вводить только буквы и пробел</p>
                                            @if($errors->has('face_position'))
                                                <div class="alert-danger alert">{!! $errors->first('face_position') !!}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">ФИО ответственного лица</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="face_fio" value="{{ old('face_fio') }}" placeholder="Иванов Андрей Анатольевич">
                                            <p>допускается вводить только буквы и пробел</p>
                                            @if($errors->has('face_fio'))
                                                <div class="alert-danger alert">{!! $errors->first('face_fio') !!}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Документ основание</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="base_document" value="{{ old('base_document') }}" placeholder="Устав или Доверенность № ____ от ____">
                                            <p>допускается вводить буквы, цифры, пробел, № и точку</p>
                                            @if($errors->has('base_document'))
                                                <div class="alert-danger alert">{!! $errors->first('base_document') !!}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Адрес местонахождения</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="place_address" value="{{ old('place_address') }}" placeholder="119049 г.Москва, ул.Лондонская, д.8 стр.1">
                                            <p>допускается вводить буквы, цифры, пробел и точку</p>
                                            @if($errors->has('place_address'))
                                                <div class="alert-danger alert">{!! $errors->first('place_address') !!}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Адрес почтовый</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="post_address" value="{{ old('post_address') }}" placeholder="119049 г.Москва, ул.Лондонская, д.8 стр.1">
                                            <p>допускается вводить буквы, цифры, пробел и точку</p>
                                            @if($errors->has('post_address'))
                                                <div class="alert-danger alert">{!! $errors->first('post_address') !!}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">ФИО контактного лица</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="contact_face_fio" value="{{ old('contact_face_fio') }}" placeholder="Андреев Анатолий Иванович">
                                            <p>допускается вводить только буквы и пробел</p>
                                            @if($errors->has('contact_face_fio'))
                                                <div class="alert-danger alert">{!! $errors->first('contact_face_fio') !!}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Телефон</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="8 (468) 524-52-43">
                                            <p>допускается вводить цифры, скобки, дефис и пробел</p>
                                            @if($errors->has('phone'))
                                                <div class="alert-danger alert">{!! $errors->first('phone') !!}</div>
                                            @endif
                                        </div>
                                    </div>

                                    {{--<div class="form-group">--}}
                                    {{--<label class="col-md-4 control-label" for="oferta">Нажимая кнопку "Зарегистрироваться", я принимаю условия <a href="#">Договора оферты</a></label>--}}
                                    {{--<input type="checkbox" class="form-control qwe" name="oferta" id="oferta">--}}
                                    {{--<div class="col-md-6">--}}
                                    {{--@if($errors->has('oferta'))--}}
                                    {{--<div class="alert-danger alert">{!! $errors->first('oferta') !!}</div>--}}
                                    {{--@endif--}}
                                    {{--</div>--}}
                                    {{--</div>--}}

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="button">
                                                Зарегистрироваться
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
