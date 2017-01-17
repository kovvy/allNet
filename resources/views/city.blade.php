@extends('layouts.main')

@section('content')


<div id="content">
    @if(isset($city))
        {!! Breadcrumbs::render('city', $city) !!}
    @else
        {!! Breadcrumbs::render('allCity') !!}
    @endif

        <style>
        .city-provider { display: inline; padding-right:30px; line-height: 140%;}
    </style>

    <br/><br/>


    @foreach($cities['city'] as $regions)
        <h2 class='city-provider'>
            {{ link_to_route('city', $title = "Интернет " .$regions->name_in, $parameters = [$regions->link]) }}
        </h2>
    @endforeach

    <br/>
    <div style="float: clear"></div>
    <!-- header -->
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

{{--    @include('templates.trackbar')--}}

@endsection