<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Интернет </title>
    <meta name="keywords" content="Интернет-провайдеры {{ $meta->name_from }}, Интернет {{ $meta->name_in }}, лучший интернет {{ $meta->name_in }}, лучший провайдер {{ $meta->name_in }}, кабельный интернет {{ $meta->name_in }}, беспроводной интернет {{ $meta->name_in }}, отзывы, подключить интернет {{ $meta->name_in }}, {{ $meta->name_from }}, 3G, 4G, WiMAX {{ $meta->name_in }}">
    <meta name="description" content="Все об интернете {{ $meta->name_in }}: кабельный и беспроводной интернет, хорошие и плохие провайдеры, отзывы и оценки, безлимитный интернет, лучший интернет {{ $meta->name_in }}">

    <meta name="_token" content="{{ csrf_token() }}">
    <meta name=viewport content="width=device-width, initial-scale=0.4">
    <meta http-equiv="content-type" content="text/html; charset=windows-1251">
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>

@yield('content')

<link href="/css/reset.css" property="stylesheet" rel="stylesheet" type="text/css" media="all"/>
<link href="/css/style.css?v=13" property="stylesheet" rel="stylesheet" type="text/css" media="all"/>
<link href="/css/trackbar.css" property="stylesheet" rel="stylesheet" type="text/css" media="all"/>

@include('templates.analytics')

</body>
</html>