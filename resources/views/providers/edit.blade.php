<div class="container">

    <h1>Edit {{ $record->name }}</h1>

    {!! Form::model($record, array('route' => array('providers.update', $record->id), 'method' => 'PUT')) !!}

    <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', NULL, array('class' => 'form-control')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('title', 'title') !!}
        {!! Form::text('title', NULL, array('class' => 'form-control')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('status', 'status') !!}
        {!! Form::text('status', NULL, array('class' => 'form-control')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('site', 'site') !!}
        {!! Form::text('site', NULL, array('class' => 'form-control')) !!}
    </div>

    <label class="mr-sm-2" for="inlineFormCustomSelect">Group</label>
    <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect" name="city">
        <option selected>Choose...</option>
        @foreach (\App\Models\Cities::all() as $city)
            <option value="{{$city->id}}">{{$city->name}}</option>
        @endforeach
    </select>
    <br>

    {!! Form::submit('Create!', array('class' => 'btn btn-primary')) !!}

    {!! Form::close() !!}

</div>