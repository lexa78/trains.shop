<!-- Модальное окно -->
<div class="modal">
    <input class="modal-open" id="modal-{{ $key + 1 }}" type="checkbox" hidden>
    <div class="modal-wrap" aria-hidden="true" role="dialog">
        <label class="modal-overlay" for="modal-{{ $key + 1 }}"></label>
        <div class="modal-dialog">
            <div class="modal-header">
                <h2>Информация об услуге {{$service->short_name}}</h2>
                <label class="btn-close" for="modal-{{ $key + 1 }}" aria-hidden="true">×</label>
            </div>
            <div class="modal-body">
                {!! $service->full_name !!}
            </div>
            {{--<div class="modal-footer">--}}
                {{--<label class="button-3" for="modal-{{ $key + 1 }}">Закрыть</label>--}}
            {{--</div>--}}
        </div>
    </div>
</div>