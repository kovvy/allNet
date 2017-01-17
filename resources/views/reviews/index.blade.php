<div class="container">

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>ID</td>
            <td>speed</td>
            <td>price</td>
            <td>trafic</td>
        </tr>
        </thead>
        <tbody>
        @foreach($records as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->speed }}</td>
                <td>{{ $value->price }}</td>
                <td>{{ $value->trafic }}</td>
                <td>

                    {{ Form::open(array('url' => 'reviews/' . $value->id, 'class' => 'pull-right')) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                    {{ Form::close() }}

                    <a class="btn btn-small btn-success" href="{{ URL::to('reviews/' . $value->id) }}">Show</a>

                    <a class="btn btn-small btn-info" href="{{ URL::to('reviews/' . $value->id . '/edit') }}">Edit</a>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>