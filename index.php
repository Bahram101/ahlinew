<?
$json = file_get_contents(
    'https://namaztimes.kz/api/praytimes?id=20720&type=json'
);
$months = [
    'islamic' => [
        'ЗУЛ-ҲИЖЖА','МУҲАРРАМ','САФАР','РАБИУЛ-АВВАЛ','РАБИУЛ-ОХИР',
        'ЖУМОДИЛ-АВВАЛ','ЖУМОДИЛ-ОХИР','РАЖАБ','ШАЪБОН','РАМАЗОН',
        'ШАВВОЛ','ЗУЛ-ҚАЪДА'
    ],
    'ru' => [
        'Январь', 'Февраль', 'Наурыз', 'Апрель',
        'Май', 'июнь', 'июль', 'август',
        'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
    ]
];

$jsonN = json_decode($json,true);
date_default_timezone_set('Asia/Almaty');
//Islamic Date
$date = strip_tags($jsonN['islamic_date']);
$chunks = explode ("-", $date, 3);
$islamic_date =  $chunks[2].' - '.$months['islamic'][$chunks[1]].', '.$chunks[0].' йил';
//Date
$month = date("n")-1;
$day = date("j");
$year = date("Y");
$Date = $day.' - '.$months['ru'][$month].', '.$year.' йил';

$array = [
    0 =>'imsak',
    1 =>'kun',
    2 =>'besin',
    3 =>'ekindi',
    4 =>'aqsham',
    5 =>'quptan'
];
$arrays = [
    0 =>'imsok',
    1 =>'kuesh',
    2 =>'peshin',
    3 =>'asr',
    4 =>'shom',
    5 =>'huftan'
];

foreach ($array as $key => $value) {
    $time = strtotime(date('G:i'));
    $Atime = strtotime($jsonN['praytimes'][$value]);
    $Btime = strtotime($jsonN['praytimes'][$array[$key+1]]);
    $Ctime = strtotime("+1 day",strtotime( $jsonN['praytimes'][$array[0]]));

    $Ctime = !empty($array[$key+1]) ? $Btime : $Ctime;
    //*Check
   // echo date('Y-n-d H:i',$Atime).'  - '.date('Y-n-d H:i',$time).'  -  '.date('Y-n-d H:i',$Ctime).'<br>';
    if($time >= $Atime and $time <= $Btime){
        //echo $Atime.'  - '.$time.' -  '.$Btime.'<br>';
        $serverDate =  $arrays[$key];
    }
}
?>
<!DOCTYPE HTML>
<html class="no-js">
<head>
    <!-- Basic Page Needs
      ================================================== -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Native Church</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <!-- Mobile Specific Metas
      ================================================== -->
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <!-- CSS
      ================================================== -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="plugins/mediaelement/mediaelementplayer.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/style2.css" rel="stylesheet" type="text/css">
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css">
    <!--<link href="css/fontawesome.css" rel="stylesheet" type="text/css">
    <link href="css/all.min.css" rel="stylesheet" type="text/css">-->
    <link href="plugins/prettyphoto/css/prettyPhoto.css" rel="stylesheet" type="text/css">


    <!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="css/ie8.css" media="screen" /><![endif]-->

    <!-- Color Style -->
    <link href="colors/color1.css" rel="stylesheet" type="text/css">
    <link href="css/custom.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="images/favicon.ico" />

    <link rel="stylesheet" id="real-accessability-css" href="/css/real-accessability.css?ver=1.0" type="text/css" media="all">
    <!-- SCRIPTS
      ================================================== -->
    <script src="js/modernizr.js"></script><!-- Modernizr -->


</head>
<body style="background: url(images/uzor.png);" class="real-accessability-body">
<!--[if lt IE 7]>
<p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
<![endif]-->
<div class="body" style="background: url(images/uzor.png);">
    <!-- Start Site Header -->
    <header class="site-header" style="background: #F8F7F3;">
        <div class="notice-bar" style="background: #142C4C">
            <div class="container">
                <div class="row" style="display: flex;align-items: flex-start; flex-wrap:wrap; justify-content: space-around">
                    <div class="col-md-3 notice-bar-title date-col" >
                        <span class="notice-bar-title-icon hidden-xs">
                            <i class="fa fa-calendar fa-3x" style="color:white"></i>
                        </span>
                        <h6 class="date text-white"><?=$islamic_date?></h6>
                        <h6 class="date" style="color:#F69C1F" id="date"><?=$Date?></h6>
                    </div>

                    <div class="col-md-2 city-col"  >
                        <div class="form-group" style="margin-bottom: 0;">
                            <input type="text" class="form-control cityInput" id="name" placeholder="Тошкент"  >
                        </div>
                    </div>

                    <div id="counter" class="col-md-4 counter time-col">
                        <div class="timer-col">
                            <span class="timer-type time" >Имсок</span>
                            <span id="imsok" class="Islamic_t">00:00</span>
                        </div>
                        <div class="timer-col">
                            <span class="timer-type time">Қуёш</span>
                            <span id="kuesh" class="Islamic_t">00:00</span>
                        </div>
                        <div class="timer-col">
                            <span class="timer-type time" >Пешин</span>
                            <span id="peshin" class="Islamic_t">00:00</span>
                        </div>
                        <div class="timer-col">
                            <span class="timer-type time">Аср</span>
                            <span id="asr" class="Islamic_t">00:00</span>
                        </div>
                        <div class="timer-col">
                            <span class="timer-type time">Шом</span>
                            <span id="shom" class="Islamic_t">00:00</span>
                        </div>
                        <div class="timer-col">
                            <span class="timer-type time">Хуфтон</span>
                            <span id="hufton" class="Islamic_t">00:00</span>
                        </div>
                    </div>

                    <div class="col-md-3 icons-col">
                        <div id="real-accessability" style="display:inherit;">
                            <ul>
                                <li><a href="#" id="real-accessability-biggerFont"></a></li>
                                <li><a href="#" id="real-accessability-smallerFont"></a></li>
                                <li><a href="#" id="real-accessability-grayscale" class="real-accessability-effect"></a></li>
                                <li><a href="#" id="real-accessability-invert" class="real-accessability-effect"></a></li>
                                <li><a href="#" id="real-accessability-linkHighlight"></a></li>
                                <li><a href="#" id="real-accessability-regularFont"></a></li>
                                <li><a href="#" id="real-accessability-reset"></a></li>

                            </ul>

                        </div>
                    </div>

                    <a href="#" class="visible-sm visible-xs menu-toggle" style="position: absolute;right: 10px;top: 0;"><i class="fa fa-bars" style="color:white;"></i></a> </div>
                </div>
            </div>

    </header>
    <!-- End Site Header -->

    <!-- Start Nav Backed Header -->
    <div class="  parallax" >
        <img src="images/header2.png"  alt="" style="width:100%" class="">
    </div>

    <div class="main-menu-wrapper">
        <!--<div class="container">-->
            <div class="row" style="width:100%">
                <div class="col-md-12">
                    <nav class="navigation"  >
                            <ul class="sf-menu">
                            <li><a href="index.html" class="whiteFont">Бош саҳифа</a> </li>
                            <li><a href="about.html" class="whiteFont">Қуръони карим</a></li>
                            <li class="megamenu"><a href="shortcodes.html" class="whiteFont">Мундарижа</a>
                                <ul class="dropdown">
                                    <li>
                                        <div class="megamenu-container container">
                                            <div class="row">
                                                <div class="col-md-3 hidden-sm hidden-xs"> <span class="megamenu-sub-title"> Иймон ва Ислом</span>

                                                </div>
                                                <div class="col-md-3"> <span class="megamenu-sub-title"><i class="fa fa-pagelines"></i> Our Ministries</span>
                                                    <ul class="sub-menu">
                                                        <li><a href="ministry.html">Women's Ministry</a></li>
                                                        <li><a href="ministry.html">Men's Ministry</a></li>
                                                        <li><a href="ministry.html">Children's Ministry</a></li>
                                                        <li><a href="ministry.html">Youth Ministry</a></li>
                                                        <li><a href="ministry.html">Prayer Requests</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-3"> <span class="megamenu-sub-title"><i class="fa fa-clock-o"></i> Upcoming Events</span>
                                                    <ul class="sub-menu">
                                                        <li><a href="single-event.html">Monday Prayer</a> <span class="meta-data">Monday | 06:00 PM</span> </li>
                                                        <li><a href="single-event.html">Staff members meet</a> <span class="meta-data">Tuesday | 08:00 AM</span> </li>
                                                        <li><a href="single-event.html">Evening Prayer</a> <span class="meta-data">Friday | 07:00 PM</span> </li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-3"> <span class="megamenu-sub-title"><i class="fa fa-cog"></i> Features</span>
                                                    <ul class="sub-menu">
                                                        <li><a href="shortcodes.html">Shortcodes</a></li>
                                                        <li><a href="typography.html">Typography</a></li>
                                                        <li><a href="shop.html">Shop <span class="label label-danger">New</span></a></li>
                                                        <li><a href="shop-sidebar.html">Shop Sidebar <span class="label label-danger">New</span></a></li>
                                                        <li><a href="shop-product.html">Single Product <span class="label label-danger">New</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="events.html" class="whiteFont">Манбалар</a></li>
                            <li><a href="sermons.html" class="whiteFont">Боғланиш</a></li>
                            <li><a href="gallery-2cols-pagination.html" class="whiteFont">Юклаш</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <!--</div>-->
        </div>
    <!-- End Hero Slider -->

    <!-- Start Content -->
    <div class="main" role="main">
        <div id="content" class="content full" >
            <div class="container">
                <div class="row ">

                    <div class="col-md-9 posts-archive" >
                        <article class="post ">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="widget sidebar-widget search-form-widget hidden-lg hidden-md">
                                        <div class="input-group input-group-lg">
                                            <input type="text" class="form-control" placeholder="Search Posts...">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button"><i class="fa fa-search fa-lg"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <h4><a href="single-event.html">Шаввол ойида рўза тутиш</a></h4>
                                    <span class="post-meta meta-data"> <span><i class="fa fa-calendar"></i> 28th Jan, 2014</span><span><i class="fa fa-archive"></i> <a href="#">Uncategorized</a></span> <span><a href="#"><i class="fa fa-comment"></i> 12</a></span></span>
                                    <p class="justify-content" style="text-align: justify">Савол: Бидъат аҳлининг ибодатлари қабул бўлмаслиги ҳақида ҳадис борми? Бор бўлса, унинг уйдирма эмаслигини қандай билишимиз мумкин? Жавоб: Ижтиҳод орқали чиқарилган хоҳлаган бир ҳукм, ҳеч қачон бошқа ижтиҳод натижасида чиқарилган ҳукм туфайли ўз кучини йўқотмаганидек хоҳлаган бир олим ҳам бошқа бир олимнинг китобида ўтган ҳадисга "уйдирма" дегани билан бу ҳадис барча олимлар наздида "уйдирма" деган ёрлиққа эга бўлмайди. Бундан ташқари, ҳозирги аксарият имом, қори каби диний хизмат вакиллари ҳам "саҳиҳ бўлиш" билан "қабул бўлиш" орасидаги фарқни билишмайди. Қуйида бу борада бироз изоҳотлар берилади: Бидъат аҳлининг ибодатлари қабул бўлмаслиги ҳақида кўплаган ҳадиси шарифлар бор. Бир ҳадиси шарифда “Бидъат аҳлининг намози, рўзаси, ҳажжи, умраси, жиҳоди, тавбаси, фарзи, нофиласи ва ҳеч қандай яхшилиги қабул бўлмайди. Ундайларнинг диндан чиқиши худди сарёғдан қил суғургандек осон бўлади” деб марҳамат қилинди. (Ибн Можа)</p>

                                    <p style="float:right"><a href="#" class="btn btn-primary batafsil">Батафсил <i class="fa fa-long-arrow-right"></i></a></p>
                                </div>
                            </div>
                        </article>
                        <article class="post ">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <h4><a href="single-event.html">Шаввол ойида рўза тутиш</a></h4>
                                    <span class="post-meta meta-data"> <span><i class="fa fa-calendar"></i> 28th Jan, 2014</span><span><i class="fa fa-archive"></i> <a href="#">Uncategorized</a></span> <span><a href="#"><i class="fa fa-comment"></i> 12</a></span></span>
                                    <p class="justify-content" style="text-align: justify" >Савол: Бидъат аҳлининг ибодатлари қабул бўлмаслиги ҳақида ҳадис борми? Бор бўлса, унинг уйдирма эмаслигини қандай билишимиз мумкин?
                                        Жавоб: Ижтиҳод орқали чиқарилган хоҳлаган бир ҳукм, ҳеч қачон бошқа ижтиҳод натижасида чиқарилган ҳукм туфайли ўз кучини йўқотмаганидек хоҳлаган бир олим ҳам бошқа бир олимнинг китобида ўтган ҳадисга "уйдирма" дегани билан бу ҳадис барча олимлар наздида "уйдирма" деган ёрлиққа эга бўлмайди. Бундан ташқари, ҳозирги аксарият имом, қори каби диний хизмат вакиллари ҳам "саҳиҳ бўлиш" билан "қабул бўлиш" орасидаги фарқни билишмайди. Қуйида бу борада бироз изоҳотлар берилади:
                                        Бидъат аҳлининг ибодатлари қабул бўлмаслиги ҳақида кўплаган ҳадиси шарифлар бор. Бир ҳадиси шарифда “Бидъат аҳлининг намози, рўзаси, ҳажжи, умраси, жиҳоди, тавбаси, фарзи, нофиласи ва ҳеч қандай яхшилиги қабул бўлмайди. Ундайларнинг диндан чиқиши худди сарёғдан қил суғургандек осон бўлади” деб марҳамат қилинди. (Ибн Можа)

                                    </p>

                                    <p style="float:right"><a href="#" class="btn btn-primary batafsil">Батафсил <i class="fa fa-long-arrow-right"></i></a></p>
                                </div>
                            </div>
                        </article>
                        <article class="post ">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">

                                    <h4><a href="single-event.html">Шаввол ойида рўза тутиш</a></h4>
                                    <span class="post-meta meta-data"> <span><i class="fa fa-calendar"></i> 28th Jan, 2014</span><span><i class="fa fa-archive"></i> <a href="#">Uncategorized</a></span> <span><a href="#"><i class="fa fa-comment"></i> 12</a></span></span>
                                    <p style="text-align: justify" >Савол: Бидъат аҳлининг ибодатлари қабул бўлмаслиги ҳақида ҳадис борми? Бор бўлса, унинг уйдирма эмаслигини қандай билишимиз мумкин? Жавоб: Ижтиҳод орқали чиқарилган хоҳлаган бир ҳукм, ҳеч қачон бошқа ижтиҳод натижасида чиқарилган ҳукм туфайли ўз кучини йўқотмаганидек хоҳлаган бир олим ҳам бошқа бир олимнинг китобида ўтган ҳадисга "уйдирма" дегани билан бу ҳадис барча олимлар наздида "уйдирма" деган ёрлиққа эга бўлмайди. Бундан ташқари, ҳозирги аксарият имом, қори каби диний хизмат вакиллари ҳам "саҳиҳ бўлиш" билан "қабул бўлиш" орасидаги фарқни билишмайди. Қуйида бу борада бироз изоҳотлар берилади: Бидъат аҳлининг ибодатлари қабул бўлмаслиги ҳақида кўплаган ҳадиси шарифлар бор. Бир ҳадиси шарифда “Бидъат аҳлининг намози, рўзаси, ҳажжи, умраси, жиҳоди, тавбаси, фарзи, нофиласи ва ҳеч қандай яхшилиги қабул бўлмайди. Ундайларнинг диндан чиқиши худди сарёғдан қил суғургандек осон бўлади” деб марҳамат қилинди. (Ибн Можа)</p>

                                    <p style="float:right"><a href="#" class="btn btn-primary batafsil">Батафсил <i class="fa fa-long-arrow-right"></i></a></p>
                                </div>
                            </div>
                        </article>

                        <ul class="pagination">
                            <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                        </ul>
                    </div>
                    <!-- Start Sidebar -->
                    <div class="col-md-3 sidebar" >
                        <div class="widget sidebar-widget search-form-widget hidden-sm hidden-xs ">
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" placeholder="Search Posts...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" >
                                        <i class="fa fa-search fa-lg" ></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="widget sidebar-widget">
                            <div class="sidebar-widget-title">
                                <h3>Бу ойда кўп ўқилганлар</h3>
                            </div>
                            <ul>
                                <li><a href="#">Faith</a> (10)</li>
                                <li><a href="#">Missions</a> (12)</li>
                                <li><a href="#">Salvation</a> (34)</li>
                                <li><a href="#">Worship</a> (14)</li>
                            </ul>
                        </div>
                        <div class="widget sidebar-widget subscribe">
                            <div class="sidebar-widget-title">
                                <h3>Аъзо бўлиш</h3>
                            </div>
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control subInput" placeholder="Email...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" >
                                         OK
                                    </button>
                                </span>
                            </div>

                        </div>
                        <div class="widget sidebar-widget tags">
                            <div class="sidebar-widget-title">
                                <h3>Теглар</h3>
                            </div>
                            <div class="tag-cloud">
                                <a href="#">Faith</a> <a href="#">Heart</a> <a href="#">Love</a> <a href="#">Praise</a> <a href="#">Sin</a> <a href="#">Soul</a> <a href="#">Missions</a> <a href="#">Worship</a> <a href="#">Faith</a> <a href="#">Heart</a> <a href="#">Love</a> <a href="#">Praise</a> <a href="#">Sin</a> <a href="#">Soul</a> <a href="#">Missions</a> <a href="#">Worship</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Featured Gallery -->
    <!--<div class="featured-gallery">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <h4>Updates from our gallery</h4>
                    <a href="#" class="btn btn-default btn-lg">More Galleries</a> </div>
                <div class="col-md-3 col-sm-3 post format-image"> <a href="http://placehold.it/600x400&amp;text=IMAGE+PLACEHOLDER" class="media-box" data-rel="prettyPhoto[Gallery]"> <img src="http://placehold.it/600x400&amp;text=IMAGE+PLACEHOLDER" alt=""> </a> </div>
                <div class="col-md-3 col-sm-3 post format-video"> <a href="http://youtu.be/NEFfnbQlGo8" class="media-box" data-rel="prettyPhoto[Gallery]"> <img src="http://placehold.it/600x400&amp;text=IMAGE+PLACEHOLDER" alt=""> </a> </div>
                <div class="col-md-3 col-sm-3 post format-image"> <a href="http://placehold.it/600x400&amp;text=IMAGE+PLACEHOLDER" class="media-box" data-rel="prettyPhoto[Gallery]"> <img src="http://placehold.it/600x400&amp;text=IMAGE+PLACEHOLDER" alt=""> </a> </div>
            </div>
        </div>
    </div>-->
    <!-- End Featured Gallery -->
    <!-- Start Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <!-- Start Footer Widgets -->
                <div class="col-md-4 col-sm-4 widget footer-widget">
                    <div class="caaba">
                        <h4>Қибла истиқомати</h4>
                        <div class="img">
                            <img src="images/01.png" alt="Logo">
                        </div>

                    </div>
                </div>
                <div class="col-md-4 col-sm-4 widget footer-widget">
                    <div class="suradua">
                        <h4>Суралар ва дуолар</h4>
                        <div class="img">
                            <img src="images/02.png" alt="Logo">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 widget footer-widget">
                    <div class="paygambar">
                        <h4>М.Саид Арвос устоз ила</h4>
                        <div class="img">
                            <img src="images/03.png" alt="Logo">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <footer class="site-footer-bottom">
        <div class="container">
            <div class="row">
                <div class="copyrights-col-left col-md-6 col-sm-6">
                    <p>&copy; 2014 NativeChurch. All Rights Reserved</p>
                </div>
                <div class="copyrights-col-right col-md-6 col-sm-6">
                    <div class="social-icons"> <a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a> <a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a> <a href="http://www.pinterest.com/" target="_blank"><i class="fa fa-pinterest"></i></a> <a href="https://plus.google.com/" target="_blank"><i class="fa fa-google-plus"></i></a> <a href="http://www.pinterest.com/" target="_blank"><i class="fa fa-youtube"></i></a> <a href="#"><i class="fa fa-rss"></i></a> </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
    <a id="back-to-top"><i class="fa fa-angle-double-up"></i></a> </div>
<script src="js/jquery-2.0.0.min.js"></script> <!-- Jquery Library Call -->
<script src="plugins/prettyphoto/js/prettyphoto.js"></script> <!-- PrettyPhoto Plugin -->
<script src="js/helper-plugins.js"></script> <!-- Plugins -->
<script src="js/bootstrap.js"></script> <!-- UI -->
<script src="js/waypoints.js"></script> <!-- Waypoints -->
<script src="plugins/mediaelement/mediaelement-and-player.min.js"></script> <!-- MediaElements -->
<script src="js/init.js"></script> <!-- All Scripts -->
<script src="plugins/flexslider/js/jquery.flexslider.js"></script> <!-- FlexSlider -->
<script src="plugins/countdown/js/jquery.countdown.min.js"></script> <!-- Jquery Timer -->

<script type='text/javascript' src='/js/real-accessability.js?ver=1.0'></script>
<div id="real-accessability">
    <a href="#" id="real-accessability-btn"><i class="real-accessability-loading"></i><i class="real-accessability-icon"></i></a>
    <ul>
        <li><a href="#" id="real-accessability-biggerFont">Increase Font</a></li>
        <li><a href="#" id="real-accessability-smallerFont">Decrease Font</a></li>
        <li><a href="#" id="real-accessability-grayscale" class="real-accessability-effect">Black & White</a></li>
        <li><a href="#" id="real-accessability-invert" class="real-accessability-effect">Inverse Colors</a></li>
        <li><a href="#" id="real-accessability-linkHighlight">Highlight Links</a></li>
        <li><a href="#" id="real-accessability-regularFont">Regular Font</a></li>
        <li><a href="#" id="real-accessability-reset">Reset</a></li>

    </ul>


</div>
<!-- Init Real Accessability Plugin -->
<script type="text/javascript">


    jQuery( document ).ready(function() {
        jQuery.RealAccessability({
            hideOnScroll: false
        });
    });
    <!-- /END -->
</script>
<script src="//code.responsivevoice.org/responsivevoice.js"></script>
<script type="text/javascript">

    function determineEnglish() {
        var body = document.body;
        var textContent = body.textContent || body.innerText;
        var textContent = textContent.replace(/\n/g," ");
        var textContent = textContent.replace(/\r/g," ");
        var textContent = textContent.replace(/\t/g," ");
        var textContent = textContent.replace(/ /g,"");
        var textLeft = textContent.replace(/\W+/g,"");
        var oldc = textContent.length;
        var newc = textLeft.length;
        var ratio = newc/oldc;
        if(ratio>.8) {
            return "english";
        } else {
            return "other";
        }
    }



    window.accPlayerStatus = "uninit";

    if(responsiveVoice.voiceSupport() && determineEnglish()=="english") {
        var obj = document.getElementById("btnAccPlay");
        obj.style.cursor="pointer";
    } else {
        document.getElementById("real-accessability-player").style.display="none";
    }

    if(navigator.userAgent.indexOf("OPR")!=-1) {
        document.getElementById("real-accessability-player").style.display="none";
    }

    function accPlayer(btnType) {

        // TURN ALL TO GRAY

        var playObj  = document.getElementById("btnAccPlay");
        var pauseObj = document.getElementById("btnAccPause");
        var stopObj  = document.getElementById("btnAccStop");

        if(btnType=="play") {

            if(window.accPlayerStatus=="uninit") {

                // CHANGE STATUS TO PLAYING
                window.accPlayerStatus = "playing";

                // LOAD THE PAGE CONTENT ALONE
                var u = location.href;
                var s = document.createElement("script");
                s.setAttribute("type","text/javascript")
                s.src = "//508fi.org/js/speech.php?u="+encodeURIComponent(u);
                document.getElementsByTagName("head")[0].appendChild(s);

                // ASSIGN CORRECT COLORS
                playObj.src  = playObj.src.replace("blue","gray");
                stopObj.src  = stopObj.src.replace("gray","red");
                pauseObj.src = pauseObj.src.replace("gray","blue");

            } else if(window.accPlayerStatus=="playing") {

            } else if(window.accPlayerStatus=="paused") {

                // CHANGE STATUS TO PLAYING
                window.accPlayerStatus = "playing";

                // RESUME PLAYING
                responsiveVoice.resume();

                // ASSIGN CORRECT COLORS
                playObj.src  = playObj.src.replace("blue","gray");
                stopObj.src  = stopObj.src.replace("gray","red");
                pauseObj.src = pauseObj.src.replace("gray","blue");

            } else if(window.accPlayerStatus=="stopped") {

                // CHANGE STATUS TO PLAYING
                window.accPlayerStatus = "playing";

                // LOAD THE PAGE CONTENT ALONE
                var u = location.href;
                var s = document.createElement("script");
                s.setAttribute("type","text/javascript")
                s.src = "//508fi.org/js/speech.php?u="+encodeURIComponent(u);
                document.getElementsByTagName("head")[0].appendChild(s);

                // ASSIGN CORRECT COLORS
                playObj.src  = playObj.src.replace("blue","gray");
                stopObj.src  = stopObj.src.replace("gray","red");
                pauseObj.src = pauseObj.src.replace("gray","blue");

            } else {

            }

        } else if(btnType=="pause") {
            if(window.accPlayerStatus=="uninit") {

            } else if(window.accPlayerStatus=="playing") {

                // CHANGE STATUS TO PLAYING
                window.accPlayerStatus = "paused";

                // PAUSE READING
                responsiveVoice.pause();

                // ASSIGN CORRECT COLORS
                playObj.src  = playObj.src.replace("gray","blue");
                stopObj.src  = stopObj.src.replace("gray","red");
                pauseObj.src = pauseObj.src.replace("blue","gray");

            } else if(window.accPlayerStatus=="paused") {

            } else if(window.accPlayerStatus=="stopped") {

            } else {

            }

        } else if(btnType=="stop") {

            if(window.accPlayerStatus=="uninit") {

            } else if(window.accPlayerStatus=="playing") {

                // STOP READING
                responsiveVoice.cancel();

                // ASSIGN CORRECT COLORS
                playObj.src  = playObj.src.replace("gray","blue");
                stopObj.src  = stopObj.src.replace("red","gray");
                pauseObj.src = pauseObj.src.replace("blue","gray");

            } else if(window.accPlayerStatus=="paused") {

                // STOP READING
                responsiveVoice.cancel();

                // ASSIGN CORRECT COLORS
                playObj.src  = playObj.src.replace("gray","blue");
                stopObj.src  = stopObj.src.replace("red","gray");
                pauseObj.src = pauseObj.src.replace("blue","gray");

            } else if(window.accPlayerStatus=="stopped") {

            } else {}

        } else {}

    }


</script>

<script>

    /*
    jsonurl = 'https://namaztimes.kz/api/praytimes?id=20720&type=json';
    $.ajax({
        url: jsonurl,
        async: false,
        dataType: 'json',
        success: function (json) {
            mydata = json;
        }
    });
    */
    mydata = JSON.parse('<?=$json?>')

    if(mydata){
        //tt = mydata;

        document.getElementById("imsok").innerHTML = mydata.praytimes.imsak;
        document.getElementById("kuesh").innerHTML = mydata.praytimes.kun;
        document.getElementById("peshin").innerHTML = mydata.praytimes.besin;
        document.getElementById("asr").innerHTML = mydata.praytimes.ekindi;
        document.getElementById("shom").innerHTML = mydata.praytimes.aqsham;
        document.getElementById("hufton").innerHTML = mydata.praytimes.quptan;

        document.getElementById("<?= $serverDate ?>").classList.add("activeTime");

        //document.getElementsById('islamic-date').innerHTML = ;
        //alert(mydata.islamic_date);


    }
    //  https://namaztimes.kz/api/praytimes?id=20720&type=json

</script>

</body>
</html>