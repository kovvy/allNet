<div class="container">

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Link</td>
            <td>Name in</td>
            <td>Name from</td>
            <td>Actions</td>
        </tr>
        </thead>
        <tbody>
        @foreach($records as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->link }}</td>
                <td>{{ $value->name_in }}</td>
                <td>{{ $value->name_from }}</td>
                <td>

                    {{ Form::open(array('url' => 'cities/' . $value->id, 'class' => 'pull-right')) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                    {{ Form::close() }}

                    <a class="btn btn-small btn-success" href="{{ URL::to('cities/' . $value->id) }}">Show</a>

                    <a class="btn btn-small btn-info" href="{{ URL::to('cities/' . $value->id . '/edit') }}">Edit</a>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>