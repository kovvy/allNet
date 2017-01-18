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

            @foreach($cities as $regions)
                <br/>
                <h2>
                    {{ link_to_route('city', $title = "Интернет " .$regions->name_in, $parameters = [$regions->link]) }}
                </h2>
            @endforeach
        </div>

        <br/><br/>

        @include('templates.internet.search')

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