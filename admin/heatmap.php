<?php
include_once('../common.php');
require_once(TPATH_CLASS . 'savar/jalali_date.php');
include_once('savar_check_permission.php');
if (checkPermission('HEAT_MAP') == false)
    die('you dont`t have permission...');

if (!isset($generalobjAdmin)) {
    require_once(TPATH_CLASS . "class.general_admin.php");
    $generalobjAdmin = new General_admin();
}
$generalobjAdmin->check_member_login();
$script = "Heat Map";
?>
<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>نقشه گرمایشی | ادمین</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>

    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <!-- GLOBAL STYLES -->
    <?php include_once('global_files.php'); ?>
    <link rel="stylesheet" href="css/style.css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
    <!--<script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>-->
    <script type='text/javascript' src='../assets/map/gmaps.js'></script>
    <!--END GLOBAL STYLES -->

    <!-- PAGE LEVEL STYLES -->
    <!-- END PAGE LEVEL  STYLES -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style>
        /* html, body {
           height: 100%;
           margin: 0;
           padding: 0;
         }
         #map {
           height: 100%;
         }
         #floating-panel {
           position: absolute;
           top: 10px;
           left: 25%;
           z-index: 5;
           background-color: #fff;
           padding: 5px;
           border: 1px solid #999;
           text-align: center;
           font-family: 'Roboto','sans-serif';
           line-height: 30px;
           padding-left: 10px;
         }
         #floating-panel {
           background-color: #fff;
           border: 1px solid #999;
           left: 25%;
           padding: 5px;
           position: absolute;
           top: 10px;
           z-index: 5;
         }*/
    </style>
</head>
<!-- END  HEAD-->
<!-- BEGIN BODY-->
<body class="padTop53 ">

<!-- MAIN WRAPPER -->
<div id="wrap">
    <?php include_once('header2.php'); ?>
    <?php include_once('left_menu.php'); ?>
    <!--PAGE CONTENT -->
    <div id="content">

        <div class="inner" style="min-height: 900px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1> نقشه گرمایشی</h1>
                </div>
            </div>
            <hr/>

            <!-- COMMENT AND NOTIFICATION  SECTION -->
            <div class="row">
                <div class="col-lg-12">

                    <div class="chat-panel panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-map-marker"></i>
                            موقعیت ها

                        </div>

                        <div class="panel-heading" style="background:none;">
                            <div class="google-map-wrap">
                                <div id="floating-panel">
                                    <button onClick="toggleHeatmap2()" id="toggleHeatmap2">مخفی کردن / نمایش دادن
                                    </button>
                                    <button onClick="changeGradient1()" id="changeGradient1">تغییر شیب</button>
                                    <button onClick="changeRadius1()" id="changeRadius1">تغییر محدوده</button>
                                    <button onClick="changeOpacity1()">تغییر شفافیت</button>
                                </div>
                                <div id="map" style="width: 100%; height: 636.5px;margin: 20px 0 0 0;"></div>
                                <!--<div id="google-map" class="google-map" style="width: 100%; height: 100%; position: absolute;">
                                </div>--><!-- #google-map -->
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-lg-12">
                    <div style="">

                    </div>
                </div>

            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <!-- END COMMENT AND NOTIFICATION  SECTION -->
    </div>


    <!--END PAGE CONTENT -->
</div>

<?php include_once('footer.php'); ?>
<?php
function getaddress($lat, $lng)
{
    $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . trim($lat) . ',' . trim($lng) . '&sensor=false';
    $json = @file_get_contents($url);
    $data = json_decode($json);
    $status = $data->status;
    if ($status == "OK") {
        return $data->results[0]->formatted_address;
    } else {
        return "Address Not Found";
    }
}

$str_date = @date('Y-m-d H:i:s', strtotime('-5 minutes'));

// register_user table
$sql2 = "SELECT vLatitude,vLongitude  FROM `register_user`
			WHERE (vLatitude != '' AND vLongitude != '' AND eStatus='Active' AND tLastOnline > '$str_date')
			ORDER BY `register_user`.iUserId ASC";
$db_users = $obj->MySQLSelect($sql2);

$sql = "SELECT iTripId,iUserId,iDriverId,tStartLat,tStartLong
              FROM trips
                WHERE tStartLat !='' AND tStartLong !='' $tsql ORDER BY iTripId DESC ";
$db_records = $obj->MySQLSelect($sql);
// echo "<pre>";print_r($db_records);exit;
$str = '';
for ($i = 0; $i < count($db_records); $i++) {
    $str .= '[' . $db_records[$i]['tStartLat'] . ', ' . $db_records[$i]['tStartLong'] . '],';
}


$map_area_lat = isset($db_records[0]['tStartLat']) ? $db_records[0]['tStartLat'] : '';
$map_area_lng = isset($db_records[0]['tStartLong']) ? $db_records[0]['tStartLong'] : '';
$str = substr($str, 0, -1);
// echo $str;exit;
?>

<script src="./dist/leaflet-heat.js"></script>
<script src="http://leaflet.github.io/Leaflet.markercluster/example/realworld.10000.js"></script>

<script type="text/javascript">
    L.cedarmaps.accessToken = '4a0a95307ce57f099d59085bf0b36c46668124b2'; // See the note below on how to get an access token

    // Getting maps info from a tileJSON source
    var tileJSONUrl = 'https://api.cedarmaps.com/v1/tiles/cedarmaps.streets.json?access_token=' + L.cedarmaps.accessToken;
    var map = L.cedarmaps.map('map', tileJSONUrl, {
        scrollWheelZoom: true,
        <?php
        echo 'center: {lat:' . $map_area_lat . ', lng: ' . $map_area_lng . '},';

        echo 'zoom: 10,';
        ?>
        fullscreenControl: true
    });


    //echo toogel

    var heat = L.heatLayer([
        <?php
        echo $str;
        ?>

    ], {radius: 25}).addTo(map);

    /*var polygon = L.polygon([
{lat: 35.6899828, lng: 51.389644},
{lat: 35.7899828, lng: 51.489644},
{lat: 35.8899828, lng: 51.689644}
]).addTo(map);*/

    //delete togel
    var heat2, heat1, heat3;

    function toggleHeatmap2() {
        map.removeLayer(heat);
        document.getElementById('toggleHeatmap2').setAttribute('onclick', 'toggleHeatmap3()');
    }

    function toggleHeatmap3() {
        heat1 = L.heatLayer([
            <?php
            echo $str;
            ?>

        ], {radius: 25}).addTo(map);
        document.getElementById('toggleHeatmap2').setAttribute('onclick', 'toggleHeatmap4()');
        document.getElementById('changeRadius1').setAttribute('onclick', 'changeRadius4()');
        document.getElementById('changeGradient1').setAttribute('onclick', 'changeGradient4()');
    }

    function toggleHeatmap4() {
        map.removeLayer(heat1);
        document.getElementById('toggleHeatmap2').setAttribute('onclick', 'toggleHeatmap3()');
    }


    //changeRadius
    function changeRadius1() {
        heat.setOptions({
            radius: 10
        });
        document.getElementById('changeRadius1').setAttribute('onclick', 'changeRadius3()');
    }


    function changeRadius3() {
        heat.setOptions({
            radius: 25
        });
        document.getElementById('changeRadius1').setAttribute('onclick', 'changeRadius1()');
    }

    function changeRadius4() {
        heat1.setOptions({
            radius: 10
        });
        document.getElementById('changeRadius1').setAttribute('onclick', 'changeRadius5()');
    }


    function changeRadius5() {
        heat1.setOptions({
            radius: 25
        });
        document.getElementById('changeRadius1').setAttribute('onclick', 'changeRadius4()');
    }


    //color heats

    function changeGradient1() {
        heat.setOptions({
            gradient: {
                0.0: 'green',
                0.5: 'yellow',
                1.0: 'red'
            }
        });
        document.getElementById('changeGradient1').setAttribute('onclick', 'changeGradient3()');
    }


    function changeGradient3() {
        heat.setOptions({
            gradient: {0.4: 'blue', 0.65: 'lime', 1: 'red'}
        });
        document.getElementById('changeGradient1').setAttribute('onclick', 'changeGradient1()');
    }


    function changeGradient4() {
        heat1.setOptions({
            gradient: {
                0.0: 'green',
                0.5: 'yellow',
                1.0: 'red'
            }
        });
        document.getElementById('changeGradient1').setAttribute('onclick', 'changeGradient5()');
    }


    function changeGradient5() {
        heat1.setOptions({
            gradient: {0.4: 'blue', 0.65: 'lime', 1: 'red'}
        });
        document.getElementById('changeGradient1').setAttribute('onclick', 'changeGradient4()');
    }


    //opacity
    var opacitydom = 0;

    function changeOpacity1() {
        if (opacitydom == 0) {
            $(".leaflet-heatmap-layer").css("opacity", "0.5");
            opacitydom = 1;
        } else {
            $(".leaflet-heatmap-layer").css("opacity", "1.5");
            opacitydom = 0;
        }

    }

</script>


<script>

    // This example requires the Visualization library. Include the libraries=visualization
    // parameter when you first load the API. For example:

    var map, heatmap, heatmap2;
    var marker, i;
    var markers = [];

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            //center: {lat: 24.8039272, lng: 67.0324286},
            center: {lat: <?php echo $map_area_lat; ?>, lng: <?php echo $map_area_lng; ?>},
            mapTypeId: 'roadmap'
        });

        heatmap = new google.maps.visualization.HeatmapLayer({
            data: getPoints(),
            map: map
        });
        changeRadius();
        changeGradient();


        heatmap2 = new google.maps.visualization.HeatmapLayer({
            data: getPoints2(),
            map: map
        });
        changeGradient2();
    }

    function toggleHeatmap() {
        heatmap.setMap(heatmap.getMap() ? null : map);
        heatmap2.setMap(heatmap2.getMap() ? null : map);
    }

    function changeGradient() {
        var gradient = [
            'rgba(0, 255, 255, 0)',
            'rgba(0, 255, 255, 1)',
            'rgba(0, 191, 255, 1)',
            'rgba(0, 127, 255, 1)',
            'rgba(0, 63, 255, 1)',
            'rgba(0, 0, 255, 1)',
            'rgba(0, 0, 223, 1)',
            'rgba(0, 0, 191, 1)',
            'rgba(0, 0, 159, 1)',
            'rgba(0, 0, 127, 1)',
            'rgba(63, 0, 91, 1)',
            'rgba(127, 0, 63, 1)',
            'rgba(191, 0, 31, 1)',
            'rgba(255, 0, 0, 1)'
        ]
        heatmap.set('gradient', heatmap.get('gradient') ? null : gradient);
    }

    function changeGradient2() {
        var gradient2 = [
            'rgba(0, 255, 100, 0)',
            'rgba(33, 99, 13, 1)',
            'rgba(33, 99, 13, 1)',
            'rgba(33, 99, 13, 1)',
            'rgba(33, 99, 13, 1)',
            'rgba(33, 99, 13, 1)',
            'rgba(33, 99, 13, 1)',
            'rgba(33, 99, 13, 1)',
            'rgba(33, 99, 13, 1)',
            'rgba(33, 99, 13, 1)',
            'rgba(33, 99, 13, 1)',
            'rgba(33, 99, 13, 1)',
            'rgba(33, 99, 13, 1)',
            'rgba(33, 99, 13, 1)'
        ]
        heatmap2.set('gradient', gradient2);
    }

    function changeRadius() {
        heatmap.set('radius', heatmap.get('radius') ? null : 20);
    }

    function changeRadius2() {
        heatmap2.set('radius', heatmap2.get('radius') ? null : 20);
    }

    function changeOpacity() {
        heatmap.set('opacity', heatmap.get('opacity') ? null : 0.2);
        heatmap2.set('opacity', heatmap2.get('opacity') ? null : 0.2);
    }

    function getPoints() {
        return [<?php echo $str;?>];
    }

    function getPoints2() {
        return [<?php echo $str2;?>];
    }

</script>

<!--<script async defer src="http://freegoogle.ir/https://maps.googleapis.com/maps/api/js?key=<?php echo $GOOGLE_SEVER_API_KEY_WEB ?>&libraries=visualization&callback=initMap"></script>
--></body>
<!-- END BODY-->
</html>
