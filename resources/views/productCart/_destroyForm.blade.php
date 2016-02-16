<div class="row">
    {!! Form::open(['route' => ['productCartDestroy', $item['id']], 'role' => 'form']) !!}

    {!! Form::hidden('_method', 'delete') !!}

    {!! Form::submit('Удалить',['class'=>'button-3']) !!}

    {!! Form::close() !!}
</div>