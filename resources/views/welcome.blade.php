@extends('app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Главное меню</div>

					<div class="panel-body">
						<ul>
							<li>О компании</li>
							<li>Контакты</li>
							@if (Auth::guest())
								<li>Что-то вместо личного кабинета</li>
							@else
								<li><a href="{{ route('cabinet') }}">Личный кабинет</a></li>
							@endif
							<li>Информация для поставщиков</li>
							<li><a href="{{ route('purchases') }}">Покупки</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
