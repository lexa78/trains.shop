<h1>Добрый день, {{ $userName }}</h1>

<p>Для Вашего заказа № {{ $orderNumber }} подготовлены и загружены документы.</p>

<p>Во вложении находятся копии этих документов.</p>

<p>Вы можете посмотреть все свои докуметы в личном кабинете в разделе {!! link_to_route('showMyDocs','Мои документы') !!}</p>

<p>С наилучшими пожеланиями, OOO TransGARANT</p>