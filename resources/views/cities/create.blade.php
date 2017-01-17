<div class="container">

    {!! Form::open(array('url' => 'cities')) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', '', array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('link', 'Link') !!}
            {!! Form::text('link', '', array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('name_in', 'Name in') !!}
            {!! Form::text('name_in', '', array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('name_from', 'Name from') !!}
            {!! Form::text('name_from', '', array('class' => 'form-control')) !!}
        </div>

        {!! Form::submit('Create!', array('class' => 'btn btn-primary')) !!}

    {!! Form::close() !!}

</div>