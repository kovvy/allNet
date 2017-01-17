$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token' : $('meta[name="_token"]').attr('content')
        }
    });
});

$(function() {
    $('#internet-filter').submit(function(e) {
        e.preventDefault();
        var m_method = $(this).attr('method');
        var m_action = $(this).attr('action');
        var m_data = $(this).serialize();
        var html;
        $.ajax({
            type: m_method,
            url: m_action,
            data: m_data,
            dataType: 'JSON',
            success: function(result) {

                if(result.length > 0)
                {
                    html = "<p style='font-size: 24px; margin-left: 245px; margin-top:-40px; color:#2159a5'>, которые Вам подходят:</p><br/>";
                    //console.log(result);

                    $.each(result, function(data){
                        // #todo доделать вывод провайдеров
                        //console.log(data);

                        //<div class='internet-block'>
                        //
                        //    <a href='{{ url("internet/$provider->link/$provider->provider_name") }}' title='Интернет от {{ $provider->title. " " .$provider->name_in }}'>
                        //    <div class='internet-logo'>
                        //    <img src='/images/{{ $provider->logo }}' alt='Интернет от {{ $provider->title. " " .$provider->name_in }}' title='Интернет от {{ $provider->title. " " .$provider->name_in }}'>
                        //    </div>
                        //    </a>
                        //    <div class="city_title"><a href="{{ url("internet/$provider->link/$provider->provider_name") }}" title="{{ $provider->title. " " . $provider->name_in }}">{{ $provider->title. " " . $provider->name_in }}</a></div>
                        //</div>
                    });

                } else {
                    html = "<p style='font-size: 24px; margin-left: 245px; margin-top:-40px; color:#2159a5'>, которые Вам подходят, не нашлось.</p><br/>";
                }

                $('#internet-list').fadeTo("slow", 0.1);
                $.scrollTo("#internet-list", 400);
                setTimeout(function() {
                    $('#internet-list').html(html).animate({
                        opacity: 1
                    }, 400);
                    $.scrollTo("#internet-list", 400)
                }, 600);
            }
        });
    });
});
$(function() {
    $('#add_comment').submit(function(e) {
        var submit = 'true';
        if ($('#username').val() == '') {
            $('#username').css('border', '1px solid red');
            submit = 'none';
        } else {
            $('#username').css('border', '1px solid #00ff2a');
        }
        if ($('#comment').val() == '') {
            $('#comment').css('border', '1px solid red');
            submit = 'none';
        } else {
            $('#comment').css('border', '1px solid #00ff2a');
        }
        if (submit == 'none') {
            return false;
        } else {
            e.preventDefault();
            var m_method = $(this).attr('method');
            var m_action = $(this).attr('action');
            var m_data = $(this).serialize();
            $.ajax({
                type: m_method,
                url: m_action,
                data: m_data,
                success: function(result) {
                    $('#add_comment').html(result);
                }
            });
        }
    });
});
$(document).ready(function() {
    $("#add_review").click(function() {
        var selected = $("#add_comment");
        $.scrollTo(selected, 400);
        return false;
    });
});