<h1>Спасибо за заказ</h1>

<p>Заказчик {{ Auth::user()->firm->organisation_name }}</p>

<?
    $totalSum = 0;
?>
@foreach($productByDepoAsKey as $depoID => $products)
    <h2>Номер заказа: {{ $depoID }}</h2>
    <p>Заказ в депо {{ \App\Models\Stantion::find($depoID)->first()->stantion_name }}</p>
    <br>
    <h3>Заказанные продукты:</h3>
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

<p>Мы свяжемся с вами в ближайшее время.</p>

<p>С наилучшими пожеланиями, OOO TransGARANT</p>