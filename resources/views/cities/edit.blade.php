<div class="container">

    <h1>Edit {{ $record->name }}</h1>

    {!! Form::model($record, array('route' => array('cities.update', $record->id), 'method' => 'PUT')) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', NULL, array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('link', 'Link') !!}
            {!! Form::text('link', NULL, array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('name_in', 'Name in') !!}
            {!! Form::text('name_in', NULL, array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('name_from', 'Name from') !!}
            {!! Form::text('name_from', NULL, array('class' => 'form-control')) !!}
        </div>

    {!! Form::submit('Create!', array('class' => 'btn btn-primary')) !!}

    {!! Form::close() !!}

</div>