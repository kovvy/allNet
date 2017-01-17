<div class="container">

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>ID</td>
            <td>Title</td>
        </tr>
        </thead>
        <tbody>
        @foreach($records as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->title }}</td>
                <td>

                    {{ Form::open(array('url' => 'services/' . $value->id, 'class' => 'pull-right')) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                    {{ Form::close() }}

                    <a class="btn btn-small btn-success" href="{{ URL::to('services/' . $value->id) }}">Show</a>

                    <a class="btn btn-small btn-info" href="{{ URL::to('services/' . $value->id . '/edit') }}">Edit</a>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>