@extends('layouts.main')

@section('content')

    <div id="content">

        {!! Breadcrumbs::render('provider', $breadcrumbs) !!}

        <div class='internet-block' style="width:330px;">

            <div class='internet-logo'>
                <img src='/images/{{ $provider->logo }}' alt='{{ $provider->title }}' title='{{ $provider->title }}'>
            </div>

            @if(! empty($tracks['avg_quality']))
                <div itemscope itemtype="http://schema.org/AggregateRating">

                    <div style="display:none" itemprop="itemReviewed" itemscope itemtype="http://schema.org/Organization">
                        <span itemprop="name">{{ $provider->title }}</span>
                    </div>
                    <meta itemprop="ratingValue" content="{{ $tracks['avg_rating'] }}" />
                    <meta itemprop="ratingCount" content="{{ $tracks['reviews_count'] }}" />
                    <meta itemprop="bestRating" content="5" />

                </div>
            <p class="short-description">

                <span>По мнению клиентов:</span><br/>

                {{ $tracks['quality']['comment'] }}, {{ mb_strtolower($tracks['speed']['comment']) }}, {{ mb_strtolower($tracks['support']['comment']) }}
           @else
                    Пока еще нет отзывов
           @endif
            </p>
            <p><button id="add_review">Оставить отзыв</button></p>
            <br/><br/>
            <!-- leftcolumn -->
            <br/>

            <h2 style="line-height:120%; width:330px; text-align: center">Еще интернет {{ $meta->name_in }}</h2>

            @foreach($similar_providers as $similar_provider)
                <div style="zoom:0.39; float:left">
                    <a href='{{ url("internet/$similar_provider->link/$similar_provider->provider_name") }}' title='{{ $similar_provider->title }}'>
                        <div class='internet-logo'>
                            <img src='/images/{{ $similar_provider->logo }}' alt='{{ $similar_provider->title }}' title='{{ $similar_provider->title }}'>
                        </div>
                    </a>
                </div>

            @endforeach

        </div>


        <script>
            var trackOutboundLink = function(url) {
                ga('send', 'event', 'outbound', url, {'hitCallback':
                        function () {
                            window.open(url, "Интернет");
                        }
                });
            }
        </script>
        <div class='description'>
            <h1 class="title">{{ $provider->title }} — интернет-провайдер {{ $provider->name_in }}</h1>
            <dl>
                <dt>Сайт:</dt> <dd>
                    <a onclick="trackOutboundLink('http://{{ $provider->site }}'); return false;" rel='nofollow' target='blank' title='{{ $provider->name_in }}' href='http://{{ $provider->site }}'>www.{{ $provider->site }}</a>
                </dd>
            </dl>
            <dl>
                <dt>Подключение:</dt> <dd>
                    <?php
                    $i = 0;
                    while($connections = mysql_fetch_array($result_connections)) {
                        if($i++ > 0) {
                            echo ', ';
                        }
                        echo $connections['type'];
                    }
                    ?>

                </dd>
            </dl>
            <dl>
                <dt>Цена:</dt> <dd>От <?=$maxmin['minprice']?> до <?=$maxmin['maxprice']?> грн/мес</dd>
            </dl>
            <dl>
                <dt>Скорость:</dt> <dd>От <?=round($maxmin['minspeed'], 1)?> до <?=round($maxmin['maxspeed'], 1)?> МБит/сек</dd>
            </dl>
            <dl>
                <dt>Услуги:</dt> <dd>
                    <?php
                    $i = 0;
                    while($services = mysql_fetch_array($result_services)) {
                        if($i++ > 0) {
                            echo ', ';
                        }
                        echo $services['title'];
                    }
                    if($i == 0) {
                        echo 'Дополнительных услуг не предоставляет';
                    }
                    ?></dd>
            </dl>
            <dl>
                <?php
                if(!empty($tracks['avg_quality'])) {
                ?>
                <dt>Качество связи:</dt>
                <dd>

                    <div class="rate" title="<?=$quality['comment']?>">
                        <div style="width:<?=(int)$tracks['avg_quality']?>%;" class="<?=$quality['class']?>" ></div>
                    </div>
                    <div class="rateperc"><?=(int)$tracks['avg_quality']?>%</div>
                </dd>
            </dl>
            <dl>
                <dt>Скорость:</dt>
                <dd>

                    <div class="rate" title="<?=$speed['comment']?>">
                        <div style="width:<?=(int)$tracks['avg_speed']?>%;" class="<?=$speed['class']?>"></div>
                    </div>
                    <div class="rateperc"><?=(int)$tracks['avg_speed']?>%</div>
                </dd>
            </dl>
            <dl>
                <dt>Техподдержка:</dt>
                <dd>

                    <div class="rate" title="<?=$support['comment']?>">
                        <div style="width:<?=(int)$tracks['avg_support']?>%;" class="<?=$support['class']?>"></div>
                    </div>
                    <div class="rateperc"><?=(int)$tracks['avg_support']?>%</div>
                </dd>
            </dl><br/><br/><br/>
            <?php } ?>

            <table id="tariffs">
                <tbody>
                <tr>
                    <th><strong>Скорость,<br />МБит/с</strong></th>
                    <th><strong>Трафик</strong></th>
                    <th>Абонплата,<br />грн/мес</th>
                </tr>
                <?php
                while($tarifs = mysql_fetch_array($result_tarifs)) {
                    echo '<tr>
							<td>' . $tarifs['speed'] . ' МБит/с</td>
							<td><strong class="red">';
                    if($tarifs['trafic'] == '0') {
                        echo '&infin;';
                    } else {
                        echo number_format($tarifs['trafic'], 0, ',', ' ') . ' МБ';
                    }
                    echo '</strong></td>
							<td>' . $tarifs['price'] . ' грн/мес</td>
						</tr>';
                }
                ?>
                </tbody>
            </table>
            <br/>
            <div class='internet-provider-description'>
                <p>Вы можете прочитать <strong>отзывы о провайдере <?php echo $provider['title'];?> <?php echo $provider['name_in']?></strong>, узнать, как <strong>подключить интернет <?php echo $provider['title']; ?></strong>, выяснить скорость интернета <strong><?php echo $provider['title'];?> <?php echo $provider['name_in']; ?></strong> </p>
            </div>
            <div id="comments">

                <?php
                $comments = mysql_fetch_array($result_comments);
                if ($comments) {
                    $ads=1;
                    echo '<h1 class="title">Отзывы о ' . $provider['title'] . ' (' . $provider['name'] . '):</h1>';
                    do {
                        $rating = round(5*(($comments['quality'] + $comments['speed'] + $comments['support'])/3/100));
                        if($rating < 1) {
                            $rating = 1;
                        }
                        $datePublished = explode(" ", $comments['created']);
                        echo '<div itemscope itemtype="http://schema.org/Review" class="comment_item">';
                        echo '<div style="display:none" itemprop="itemReviewed" itemscope itemtype="http://schema.org/Organization">
						<span itemprop="name">'. $provider['title']. '</span>
		</div>';

                        echo ' <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="hidden">
				<meta itemprop="worstRating" content = "1" >
				<meta itemprop="bestRating" content = "5" >
				<meta itemprop="ratingValue" content="' . $rating . '" >
			</div>';
                        echo '<p class="datetime">' . $comments['created'] . '</p>';
                        echo '<meta itemprop="datePublished" content="' . $datePublished[0] . '" >';
                        echo '<p itemprop="author" class="username">' . $comments['username'] . '</p>';

                        echo '<p itemprop="reviewBody">' . $comments['comment'] . '</p>';
                        echo '</div>';

                        if($ads == 1) {
                            echo '';
                            $ads = 0;
                        }
                    }while($comments = mysql_fetch_array($result_comments));
                    $comments = 1;
                }
                ?>
                <?php
                include_once('cssjs.tpl');
                ?>
                <form id="add_comment" method="POST" action="/addcomment.php">
                    <p class="title">Оставьте отзыв о <?=$provider['title']?> (<?=$provider['name']?>) <?php if(!$comments) echo 'первым!'; ?></p>
                    <p>Представьтесь:<br/><input type="text" name="username" id="username"/></p>

                    <p>Ваши впечатления о провайдере:<br/><textarea name="comment" id="comment"></textarea></p>
                    <p class="over-trackbar">Оцените качество связи: <span id="quality-text" class="text-review">отличная связь, работает как часы</span></p>

                    <script type="text/javascript">
                        trackbar.getObject('quality').init({

                            onMove : function() {
                                try {
                                    document.getElementById("quality-review").value = this.leftValue;
                                    quality = document.getElementById("quality-text");

                                    if(this.leftValue >= 70) {
                                        quality.innerHTML = 'отличная связь, работает как часы';

                                    }
                                    if(this.rightValue < 70 && this.rightValue > 30) {
                                        quality.innerHTML = 'перебоев почти нет, сносная связь';
                                    }
                                    if(this.rightValue < 30) {
                                        quality.innerHTML = 'плохая связь, одни перебои';
                                    }
                                } catch(e) {}

                            },
                            dual: false,
                            width : 250,
                            leftLimit : 0,
                            leftValue : 75,
                            rightLimit : 100,
                            rightValue : 0,
                            roundUp : 1,
                            clearLimits: true,
                            clearValues: false
                        });
                    </script>

                    <input type="hidden" name="quality" ID="quality-review" value="75"/>

                    <p class="over-trackbar">Оцените скорость: <span id="speed-text" class="text-review">хорошая скорость, соответствует тарифам</span></p>
                    <script type="text/javascript">
                        trackbar.getObject('speed').init({

                            onMove : function() {
                                try {
                                    document.getElementById("speed-review").value = this.leftValue;
                                    quality = document.getElementById("speed-text");

                                    if(this.leftValue >= 70) {
                                        quality.innerHTML = 'хорошая скорость, соответствует тарифам';

                                    }
                                    if(this.rightValue < 70 && this.rightValue > 30) {
                                        quality.innerHTML = 'иногда подтормаживает';
                                    }
                                    if(this.rightValue < 30) {
                                        quality.innerHTML = 'ужасная скорсть, не соответствует тарифам';
                                    }
                                } catch(e) {}

                            },
                            dual: false,
                            width : 250,
                            leftLimit : 0,
                            leftValue : 81,
                            rightLimit : 100,
                            rightValue : 0,
                            roundUp : 1,
                            clearLimits: true,
                            clearValues: false
                        });
                    </script>
                    <input type="hidden" name="speed" ID="speed-review" value="81"/>

                    <p class="over-trackbar">Оцените сервис техподдержки: <span id="support-text" class="text-review">техподдержка на уровне, отвечают, помогают</span></p>
                    <script type="text/javascript">
                        trackbar.getObject('support').init({

                            onMove : function() {
                                try {
                                    document.getElementById("support-review").value = this.leftValue;
                                    quality = document.getElementById("support-text");

                                    if(this.leftValue >= 70) {
                                        quality.innerHTML = 'техподдержка на уровне, отвечают, помогают';

                                    }
                                    if(this.rightValue < 70 && this.rightValue > 30) {
                                        quality.innerHTML = 'сложно дозвониться в техподдержку';
                                    }
                                    if(this.rightValue < 30) {
                                        quality.innerHTML = 'в техподдержке одни хамы';
                                    }
                                } catch(e) {}

                            },
                            dual: false,
                            width : 250,
                            leftLimit : 0,
                            leftValue : 73,
                            rightLimit : 100,
                            rightValue : 0,
                            roundUp : 1,
                            clearLimits: true,
                            clearValues: false
                        });
                    </script>
                    <input type="hidden" name="support" ID="support-review" value="73"/>
                    <input type="hidden" name="provider_id" value="<?=$provider['id']?>"/>
                    <button id="add_review_comment">Отправить отзыв</button>
                </form>
                <div style="margin-top:40px; text-align: center">
                    По вопросам сотрудничества пишите на: <a href="mailto:intracomof@gmail.com">intracomof@gmail.com</a>
                </div>
            </div>
        </div>

    </div>


@endsection