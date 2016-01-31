<div class="row">
    {!! Form::open(['action' => ['FirmController@update'], 'role' => 'form']) !!}
	{!! Form::hidden('_method', 'put') !!}

    <div class="form-group">
        <label class="col-md-4 control-label">Полное наименование организации</label>
        <div class="col-md-6">
            <input type="text" class="form-control" value="{{ $firm->full_organisation_name }}" name="full_organisation_name" placeholder="Общество с ограниченной ответственностью Вагоностроитель">
            <p>допускается вводить буквы, цифры и пробел</p>
            @if($errors->has('full_organisation_name'))
                <div class="alert-danger alert">{!! $errors->first('full_organisation_name') !!}</div>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Краткое наименование организации</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="organisation_name" value="{{ $firm->organisation_name }}" placeholder="ООО Вагоностроитель">
            <p>допускается вводить буквы, цифры и пробел</p>
            @if($errors->has('organisation_name'))
                <div class="alert-danger alert">{!! $errors->first('organisation_name') !!}</div>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">ОКПО</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="okpo" value="{{ $firm->okpo }}" placeholder="5861485312">
            <p>допускается вводить только цифры (10 цифр)</p>
            @if($errors->has('okpo'))
                <div class="alert-danger alert">{!! $errors->first('okpo') !!}</div>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">ОГРН</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="ogrn" value="{{ $firm->ogrn }}" placeholder="8546751359742">
            <p>допускается вводить только цифры (13 цифр)</p>
            @if($errors->has('ogrn'))
                <div class="alert-danger alert">{!! $errors->first('ogrn') !!}</div>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">ИНН</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="inn" value="{{ $firm->inn }}" placeholder="4746595421349">
            <p>допускается вводить только цифры (13 цифр)</p>
            @if($errors->has('inn'))
                <div class="alert-danger alert">{!! $errors->first('inn') !!}</div>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">КПП</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="kpp" value="{{ $firm->kpp }}" placeholder="697201001">
            <p>допускается вводить только цифры (9 цифр)</p>
            @if($errors->has('kpp'))
                <div class="alert-danger alert">{!! $errors->first('kpp') !!}</div>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Номер расчетного счета</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="rs" value="{{ $firm->rs }}" placeholder="2574686480000000127">
            <p>допускается вводить только цифры (20 цифр)</p>
            @if($errors->has('rs'))
                <div class="alert-danger alert">{!! $errors->first('rs') !!}</div>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">БИК банка</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="bik" value="{{ $firm->bik }}" placeholder="421658437">
            <p>допускается вводить только цифры (9 цифр)</p>
            @if($errors->has('bik'))
                <div class="alert-danger alert">{!! $errors->first('bik') !!}</div>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Наименование банка</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="bank" value="{{ $firm->bank }}" placeholder="ЗАО КИВИ Банк">
            <p>допускается вводить буквы, цифры, пробел и точку</p>
            @if($errors->has('bank'))
                <div class="alert-danger alert">{!! $errors->first('bank') !!}</div>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Коррсчет банка</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="ks" value="{{ $firm->ks }}" placeholder="48561214804957431579">
            <p>допускается вводить только цифры (20 цифр)</p>
            @if($errors->has('ks'))
                <div class="alert-danger alert">{!! $errors->first('ks') !!}</div>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Должность ответственного лица</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="face_position" value="{{ $firm->face_position }}" placeholder="Директор">
            <p>допускается вводить только буквы и пробел</p>
            @if($errors->has('face_position'))
                <div class="alert-danger alert">{!! $errors->first('face_position') !!}</div>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">ФИО ответственного лица</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="face_fio" value="{{ $firm->face_fio }}" placeholder="Иванов Андрей Анатольевич">
            <p>допускается вводить только буквы и пробел</p>
            @if($errors->has('face_fio'))
                <div class="alert-danger alert">{!! $errors->first('face_fio') !!}</div>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Документ основание</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="base_document" value="{{ $firm->base_document }}" placeholder="Устав или Доверенность № ____ от ____">
            <p>допускается вводить буквы, цифры, пробел, № и точку</p>
            @if($errors->has('base_document'))
                <div class="alert-danger alert">{!! $errors->first('base_document') !!}</div>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Адрес местонахождения</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="place_address" value="{{ $firm->place_address }}" placeholder="119049 г.Москва, ул.Лондонская, д.8 стр.1">
            <p>допускается вводить буквы, цифры, пробел и точку</p>
            @if($errors->has('place_address'))
                <div class="alert-danger alert">{!! $errors->first('place_address') !!}</div>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Адрес почтовый</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="post_address" value="{{ $firm->post_address }}" placeholder="119049 г.Москва, ул.Лондонская, д.8 стр.1">
            <p>допускается вводить буквы, цифры, пробел и точку</p>
            @if($errors->has('post_address'))
                <div class="alert-danger alert">{!! $errors->first('post_address') !!}</div>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">ФИО контактного лица</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="contact_face_fio" value="{{ $firm->contact_face_fio }}" placeholder="Андреев Анатолий Иванович">
            <p>допускается вводить только буквы и пробел</p>
            @if($errors->has('contact_face_fio'))
                <div class="alert-danger alert">{!! $errors->first('contact_face_fio') !!}</div>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Телефон</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="phone" value="{{ $firm->phone }}" placeholder="8 (468) 524-52-43">
            <p>допускается вводить цифры, скобки, дефис и пробел</p>
            @if($errors->has('phone'))
                <div class="alert-danger alert">{!! $errors->first('phone') !!}</div>
            @endif
        </div>
    </div>

    @if(Auth::user()->role->id == \App\Models\User::ADMIN)
        <div class="form-group">
            <label class="col-md-4 control-label">ФИО бухгалтера</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="accountant_fio" value="{{ $firm->accountant_fio }}" placeholder="Счетоводова Клавдия Вседалавовна">
                <p>допускается вводить только буквы и пробел</p>
                @if($errors->has('accountant_fio'))
                    <div class="alert-danger alert">{!! $errors->first('accountant_fio') !!}</div>
                @endif
            </div>
        </div>
    @endif

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            {!! Form::submit('Изменить', ['class'=>'btn btn-success']) !!}
        </div>
    </div>

    {!! Form::close() !!}
</div>
