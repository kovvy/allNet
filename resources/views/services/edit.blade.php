<div class="container">

    <h1>Edit {{ $record->name }}</h1>

    {!! Form::model($record, array('route' => array('services.update', $record->id), 'method' => 'PUT')) !!}

        <div class="form-group">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', NULL, array('class' => 'form-control')) !!}
        </div>

    {!! Form::submit('Create!', array('class' => 'btn btn-primary')) !!}

    {!! Form::close() !!}

</div>