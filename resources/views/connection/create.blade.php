<div class="container">

    {!! Form::open(array('url' => 'connection')) !!}

        <div class="form-group">
            {!! Form::label('type', 'type') !!}
            {!! Form::text('type', '', array('class' => 'form-control')) !!}
        </div>

        {!! Form::submit('Create!', array('class' => 'btn btn-primary')) !!}

    {!! Form::close() !!}

</div>