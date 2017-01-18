<!-- header -->
@include('templates.trackbar')

    {!! Form::open(['route' => 'search', 'id' => 'internet-filter']) !!}

        <dl>
        <dt>Подключение:</dt>
        <dd>
            <label for="inlineFormCustomSelect"></label>
            <select id="inlineFormCustomSelect" name="connection">
                <option value="any">Любое</option>
                @foreach ($services as $service)
                    <option value="{{$service->id}}">{{$service->title}}</option>
                @endforeach
            </select>
        </dd>
        </dl>
        <dl>
        <dt>Регион:</dt>
        <dd>

        <label for="inlineFormCustomSelect"></label>
        <select id="inlineFormCustomSelect" name="region">
            <option selected>Вся Украина</option>
            @foreach ($cities as $city)
                <option value="{{$city->id}}">{{$city->name}}</option>
            @endforeach
        </select>
        </dd>
        </dl>
        <dl>
        {{--<dt>Цена:</dt>--}}
        {{--<dd>--}}

        {{--<script type="text/javascript">--}}
            {{--trackbar.getObject('cost').init({--}}

            {{--onMove : function() {--}}
                {{--try {--}}
                    {{--document.getElementById("begin-cost").value = this.leftValue;--}}
                    {{--document.getElementById("end-cost").value = this.rightValue;--}}
                {{--} catch(e) {}--}}

                {{--},--}}

                {{--width : 250,--}}

                {{--leftLimit : {{ $price['minprice'] }},--}}
                {{--leftValue : {{ $price['minprice'] }},--}}
                {{--rightLimit : {{ $price['maxprice'] }},--}}
                {{--rightValue : {{ $price['maxprice'] }},--}}
                {{--roundUp : 1,--}}
                {{--clearLimits: true,--}}
                {{--clearValues: true--}}
            {{--});--}}

        {{--</script>--}}

        {{--<span class="cost">--}}
            {{--от <input id="begin-cost" name="begin_cost" type="text" value='{{ $price['minprice'] }}'>--}}
            {{--до <input id="end-cost" name="end_cost" type="text" value='{{ $price['maxprice'] }}'> грн/месяц--}}
        {{--</span>--}}
        {{--</dd>--}}
        {{--</dl>--}}
        {{--<dl>--}}
        {{--<dt>Скорость:</dt>--}}
        {{--<dd>--}}
        {{--<script type="text/javascript">--}}
            {{--trackbar.getObject('speed').init({--}}

                {{--onMove : function() {--}}
                    {{--try {--}}
                    {{--document.getElementById("begin-speed").value = this.leftValue;--}}
                    {{--document.getElementById("end-speed").value = this.rightValue;--}}
                    {{--} catch(e) {}--}}

                {{--},--}}

                {{--width : 250,--}}
                {{--leftLimit : {{ round($speed['minspeed'], 1) }},--}}
                {{--leftValue : {{ $speed['minspeed'] }},--}}
                {{--rightLimit : {{ $speed['maxspeed'] }},--}}
                {{--rightValue : {{ $speed['maxspeed'] }},--}}
                {{--roundUp : 0.5,--}}
                {{--clearLimits: true,--}}
                {{--clearValues: true--}}
            {{--});--}}

        {{--</script>--}}

        {{--<span class="cost">--}}
            {{--от <input id="begin-speed" name="begin_speed" type="text" value='{{ round($speed['minspeed'], 3) }}'>--}}
            {{--до <input id="end-speed" name="end_speed" type="text" value='{{ $speed['maxspeed'] }}'> МБит/сек--}}
        {{--</span>--}}
        {{--</dd>--}}
        {{--</dl>--}}
        {{--<dl>--}}
        {{--<dt>&nbsp;</dt>--}}
        {{--<dd>--}}
        {{--<br/>--}}
        <input type="hidden" name="search" value="1" />
        <p><button id="view">Показать предложения</button></p>
        </dd>
        </dl>

    {!! Form::close() !!}