<?php
  include_once("common.php");
  $script="Home";
  $meta_arr = $generalobj->getsettingSeo(7);
    /*$sql = "SELECT * from configurations where eStatus = 'Active'" ;
    $db_config= $obj->MySQLSelect($sql);
    foreach ($db_config as $key => $value) {
        $vName=$value['vName'];
        $$vName=$value['vValue'];
    }*/

        $meta1 = $generalobj->getStaticPage(23,$_SESSION['sess_lang']);
        $meta2 = $generalobj->getStaticPage(24,$_SESSION['sess_lang']);
        $meta3 = $generalobj->getStaticPage(25,$_SESSION['sess_lang']);
        $meta4 = $generalobj->getStaticPage(26,$_SESSION['sess_lang']);
        $homepage_banner = $generalobj->getStaticPage(19,$_SESSION['sess_lang']);
        $image1 = $generalobj->getStaticPage(27,$_SESSION['sess_lang']);
        $image2 = $generalobj->getStaticPage(28,$_SESSION['sess_lang']);
        $image3 = $generalobj->getStaticPage(29,$_SESSION['sess_lang']);
        $image4 = $generalobj->getStaticPage(30,$_SESSION['sess_lang']);
?>
<!DOCTYPE html>
<html lang="en" dir="<?php echo (isset($_SESSION['eDirectionCode']) && $_SESSION['eDirectionCode'] != "")?$_SESSION['eDirectionCode']:'ltr';?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!--<title><?php echo $SITE_NAME?></title>-->
	<title><?php echo $meta_arr['meta_title'];?></title>
    <!-- Default Top Script and css -->
    <?php include_once("top/top_script.php");?>
    <!-- End: Default Top Script and css-->
</head>
<body>
    <!-- home page -->
    <div id="main-uber-page">
        <!-- Left Menu --> 
    <?php include_once("top/left_menu.php");?>
    <!-- End: Left Menu-->
        <!-- Top Menu -->
        <?php include_once("top/header_topbar.php");?>
        <!-- End: Top Menu-->
        <!-- First Section -->
		<?php include_once("top/header.php");?>
        <!-- End: First Section -->
        <?php include_once("top/home-dd.php");?>
   
    <!-- home page end-->
    <!-- footer part -->
    <?php include_once('footer/footer_home.php');?>
    
    <div style="clear:both;"></div>
     </div>
    <!-- footer part end -->
<!-- Footer Script -->
<?php include_once('top/footer_script.php');?>
<!-- End: Footer Script -->
</body>
</html>