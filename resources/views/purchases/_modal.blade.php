<!-- Модальное окно -->
<div class="modal">
    <input class="modal-open" id="modal-{{ $key + 1 }}" type="checkbox" hidden>
    <div class="modal-wrap" aria-hidden="true" role="dialog">
        <label class="modal-overlay" for="modal-{{ $key + 1 }}"></label>
        <div class="modal-dialog">
            <div class="modal-header">
                <h2>Подробное описание услуги {{$service->short_name}}</h2>
                <label class="btn-close" for="modal-{{ $key + 1 }}" aria-hidden="true">×</label>
            </div>
            <div class="modal-body">
                <p><b>Короткое название:&nbsp;&nbsp;&nbsp;</b>{{ $service->short_name }}</p>
                <p><b>Полное название:&nbsp;&nbsp;&nbsp;</b>{{ $service->full_name }}</p>
                <p><b>Единица измерения:&nbsp;&nbsp;&nbsp;</b>{{ $service->unit }}</p>
                <p><b>Срок исполнения:&nbsp;&nbsp;&nbsp;</b>{{ $service->period }}</p>
                <p><b>Требуемые документы:&nbsp;&nbsp;&nbsp;</b>{{ $service->documents }}</p>
                <p><b>Цена:&nbsp;&nbsp;&nbsp;</b>{{ $service->price }} руб.</p>
                <p><b>Для этой услуги нужно указывать станцию:&nbsp;&nbsp;&nbsp;</b>{{ $service->need_station ? 'ДА' : 'НЕТ' }}</p>
            </div>
            <div class="modal-footer">
                <label class="button-3" for="modal-{{ $key + 1 }}">Закрыть</label>
            </div>
        </div>
    </div>
</div>