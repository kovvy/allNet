<?php

// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Поиск интернет-провайдеров', route('home'));
});

// Home > Internet
Breadcrumbs::register('allCity', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Интернет в Украине', route('allCity'));
});

// Home > Internet > [City]
Breadcrumbs::register('city', function($breadcrumbs, $city)
{
    $breadcrumbs->parent('allCity');
    $breadcrumbs->push($city->name, route('city', $city->link));
});

// Home > Internet > [City] > [Provider]
Breadcrumbs::register('provider', function($breadcrumbs, $provider)
{
    $breadcrumbs->parent('city', $provider->city);
    $breadcrumbs->push($provider->title, route('city', $provider->id));
});