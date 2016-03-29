<h1>Спасибо за заказ</h1>

<p>Заказчик {{ Auth::user()->firm->organisation_name }}</p>

<h2>Номер заказа: {{ $service->id }}</h2>
<p><b>Заказанная услуга: </b>{{ $service->service_name }}</p>
<p><b>Номера вагонов: </b>{{ $service->more_info }}</p>
@if($service->station_names)
    <p><b>Название станции: </b>{{ $service->station_names }}</p>
@endif

<p><b>Предварительная стоимость услуги: </b>{{ $service->service_price }} руб.</p>

<p>В ближайшее время с Вами свяжется наш менеджер для обсуждения деталей.</p>

<p>С наилучшими пожеланиями, OOO "Гатис"</p>