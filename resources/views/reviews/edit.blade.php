<div class="container">

    <h1>Edit {{ $record->name }}</h1>

    {!! Form::model($record, array('route' => array('reviews.update', $record->id), 'method' => 'PUT')) !!}

        <div class="form-group">
            {!! Form::label('speed', 'Speed') !!}
            {!! Form::text('speed', '', array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('price', 'Price') !!}
            {!! Form::text('price', '', array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('trafic', 'Trafic') !!}
            {!! Form::text('trafic', '', array('class' => 'form-control')) !!}
        </div>

    {!! Form::submit('Create!', array('class' => 'btn btn-primary')) !!}

    {!! Form::close() !!}

</div>