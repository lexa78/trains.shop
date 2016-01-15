<div class="row">
    {!! Form::open(['route' => ['productCartDestroy', $item['id']], 'role' => 'form']) !!}

    {!! Form::hidden('_method', 'delete') !!}

    {!! Form::submit('Удалить',['class'=>'btn btn-danger']) !!}

    {!! Form::close() !!}
</div>