<div class="container">

    {!! Form::open(array('url' => 'providers', 'files'=> true)) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', '', array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('title', 'title') !!}
            {!! Form::text('title', '', array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('status', 'status') !!}
            {!! Form::text('status', '', array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('site', 'site') !!}
            {!! Form::text('site', '', array('class' => 'form-control')) !!}
        </div>

        <label class="mr-sm-2" for="inlineFormCustomSelect">Group</label>
        <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect" name="city">
            <option selected>Choose...</option>
            @foreach (\App\Models\Cities::all() as $city)
                <option value="{{$city->id}}">{{$city->name}}</option>
            @endforeach
        </select>
        <br>

        {!! Form::label('logo', 'Фото') !!}
            {!! Form::file('logo', ['id'=>'photo']) !!}
        {!! Form::submit('Create!', array('class' => 'btn btn-primary')) !!}

    {!! Form::close() !!}

</div>