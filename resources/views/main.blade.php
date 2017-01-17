@extends('layouts.main')
@section('content')

    <div id="content">

        <img style="margin-left: 110px; float:left;" src="/images/internet.png" alt="Хороший интернет"/>
        <h1 id="navigation" >
            <a style="float:right" href='{{ route('allCity') }}'>Все интернет-провайдеры {{ $meta->name_from }}</a>

        </h1>

        <div style="float: right; margin-top: 30px; margin-left: 170px; line-height:130%; width:240px; color: #3c3c3c;">
		<span style="font-size: 12px;">
			Все об интернете {{ $meta->name_in }}:
			<br/>&nbsp; - Кабельный и беспроводной интернет
			<br/>&nbsp; - Хорошие и плохие провайдеры
			<br/>&nbsp; - Отзывы и оценки
			<br/>&nbsp; - Безлимитный интернет
		</span>
            <br/>

            @foreach($cities['city'] as $regions)
                <br/>
                <h2>
                    {{ link_to_route('city', $title = "Интернет " .$regions->name_in, $parameters = [$regions->link]) }}
                </h2>
            @endforeach
        </div>


        <br/><br/>
        <!-- header -->
        @include('templates.trackbar')

        {!! Form::open(['route' => 'search', 'id' => 'internet-filter']) !!}

            <dl>
                <dt>Подключение:</dt>
                <dd>
                    {{ Form::select('connection', $services, 'any') }}
                </dd>
            </dl>
            <dl>
                <dt>Регион:</dt>
                <dd>
                    {{ Form::select('region', $cities['regions'], '0') }}
                </dd>
            </dl>
            <dl>
                <dt>Цена:</dt>
                <dd>
                    <script type="text/javascript">
                        trackbar.getObject('cost').init({

                            onMove : function() {
                                try {
                                    document.getElementById("begin-cost").value = this.leftValue;
                                    document.getElementById("end-cost").value = this.rightValue;
                                } catch(e) {}

                            },
                            width : 250,
                            leftLimit : {{ $price['minprice'] }},
                            leftValue : {{ $price['minprice'] }},
                            rightLimit : {{ $price['maxprice'] }},
                            rightValue : {{ $price['maxprice'] }},
                            roundUp : 1,
                            clearLimits: true,
                            clearValues: true
                        });

                    </script>

                <span class="cost">
                от <input id="begin-cost" name="begin_cost" type="text" value='{{ $price['minprice'] }}'>
                до <input id="end-cost" name="end_cost" type="text" value='{{ $price['maxprice'] }}'> грн/месяц
                </span>
                </dd>
            </dl>
            <dl>
                <dt>Скорость:</dt>
                <dd>
                    <script type="text/javascript">
                        trackbar.getObject('speed').init({

                            onMove : function() {
                                try {
                                    document.getElementById("begin-speed").value = this.leftValue;
                                    document.getElementById("end-speed").value = this.rightValue;
                                } catch(e) {}

                            },
                            width : 250,
                            leftLimit : {{ round($speed['minspeed'], 1) }},
                            leftValue : {{ $speed['minspeed'] }},
                            rightLimit : {{ $speed['maxspeed'] }},
                            rightValue : {{ $speed['maxspeed'] }},
                            roundUp : 0.5,
                            clearLimits: true,
                            clearValues: true
                        });

                    </script>

                <span class="cost">
                от <input id="begin-speed" name="begin_speed" type="text" value='{{ round($speed['minspeed'], 3) }}'>
                до <input id="end-speed" name="end_speed" type="text" value='{{ $speed['maxspeed'] }}'> МБит/сек
                </span>
                </dd>
            </dl>
            <dl>
                <dt>&nbsp;</dt>
                <dd>
                    <br/>
                    <input type="hidden" name="search" value="1" />
                    <p><button id="view">Показать предложения</button></p>
                </dd>
            </dl>

        {!! Form::close() !!}


        <p style='font-size: 24px; color:#2159a5'>Интернет-провайдеры</p><br/>
        <div id="internet-list">


            @foreach($providers as $provider)
                <div class='internet-block'>

                    <a href='{{ url("internet/$provider->link/$provider->provider_name") }}' title='Интернет от {{ $provider->title. " " .$provider->name_in }}'>
                        <div class='internet-logo'>
                            <img src='/images/{{ $provider->logo }}' alt='Интернет от {{ $provider->title. " " .$provider->name_in }}' title='Интернет от {{ $provider->title. " " .$provider->name_in }}'>
                        </div>
                    </a>
                    <div class="city_title"><a href="{{ url("internet/$provider->link/$provider->provider_name") }}" title="{{ $provider->title. " " . $provider->name_in }}">{{ $provider->title. " " . $provider->name_in }}</a></div>
                </div>
            @endforeach

                {!! $providers->links() !!}


        </div>


    </div>


@endsection