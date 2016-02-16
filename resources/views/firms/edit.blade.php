@extends('public')

@section('content')
    <section id="content"><div class="ic"></div>
        <div class="sub-page">
            <div class="sub-page-left box-9">
                <h2 class="p5">Редактирование информации о фирме {{ $firm->organisation_name }}</h2>
                @include('firms._form')
            </div>
        </div>
    </section>
@endsection