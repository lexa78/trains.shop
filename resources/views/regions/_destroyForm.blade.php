<div class="row">
    {!! Form::open(['route' => ['regions.destroy', $region->id], 'role' => 'form']) !!}

    {!! Form::hidden('_method', 'delete') !!}

    {!! Form::submit('Удалить',['class'=>'btn btn-danger']) !!}

    {!! Form::close() !!}
</div>