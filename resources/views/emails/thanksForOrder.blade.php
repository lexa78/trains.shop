<h1>Спасибо за заказ</h1>

<p>Заказчик {{ Auth::user()->firm->organisation_name }}</p>

<?
    $totalSum = 0;
?>
@foreach($productByDepoWithOrderIdAsKey as $orderID => $products)
    <h2>Номер заказа: {{ $orderID }}</h2>
    {{--<p>Заказ в депо {{ \App\Models\Stantion::find($depoID)->first()->stantion_name }}</p>--}}
    <p>Заказ в депо {{ $products[0][5] }}</p>
    <h3>Заказанные детали:</h3>
    <ol>
        <?
            $res = 0;
            $totalSumInDepo = 0;
        ?>
        @foreach($products as $product)
            <li>
                {{ $product[0] }} (x{{ $product[1] }}): RUR {{ $res = $product[1]*$product[2] }}
            </li>
            <?
                $totalSum += $res;
                $totalSumInDepo += $res;
            ?>
        @endforeach
    </ol>
    <h4>Итого: сумма по депо RUR {{ $totalSumInDepo }}</h4>
@endforeach

<h3>Итого RUR {{ $totalSum }}</h3>

<p>Просьба уведомить нас об оплате счета(ов).</p>

<p>С наилучшими пожеланиями, OOO "Гатис"</p>