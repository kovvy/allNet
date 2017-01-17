<div class="container">

    {!! Form::open(array('url' => 'services')) !!}

        <div class="form-group">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', '', array('class' => 'form-control')) !!}
        </div>

        {!! Form::submit('Create!', array('class' => 'btn btn-primary')) !!}

    {!! Form::close() !!}

</div>