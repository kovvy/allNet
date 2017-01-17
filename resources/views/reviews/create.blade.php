<div class="container">

    {!! Form::open(array('url' => 'reviews')) !!}

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

        <div class="form-group">
            {!! Form::hidden('provider_id', 'provider_id') !!}
        </div>

        {!! Form::submit('Create!', array('class' => 'btn btn-primary')) !!}

    {!! Form::close() !!}

</div>