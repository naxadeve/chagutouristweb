<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="vso">
    <link rel="shortcut icon" href="img/favicon.png">

    <title><?php echo $template['title'];?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url();?>assets/admin/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>assets/admin/css/style.css?1" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="lock-screen" onload="startTime()" >
<div style="position: absolute; top: 0;left: 0;bottom: 0;right: 0; background:rgba(0,0,0,0.5); z-index: 2"></div>
    <div class="lock-wrapper" style="overflow:hidden; position:relative; margin-top: 35px; background: #ffff; padding-top: 30px; z-index: 10;">

        <div id="time" style="color:rgba(0,0,0,0.5); font-weight:300; position:relative; object-fit:center; " ></div>


        <div class="lock-box text-center">
        <div class="text-center mt-5 mb-5"> 
             <img src="<?php echo SITE_SLOGAN_EN ?>" alt="admin" height=60; style="position: static;">
             </div>
        <div>
            <?php echo SITE_NAME_EN ?>
        </div>
        </div>
            <?php echo $template['body'];?>
        </div>
    </div>
    <script>
        function startTime()
        {
            var today=new Date();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            // add a zero in front of numbers<10
            m=checkTime(m);
            s=checkTime(s);
            document.getElementById('time').innerHTML=h+":"+m+":"+s;
            t=setTimeout(function(){startTime()},500);
        }

        function checkTime(i)
        {
            if (i<10)
            {
                i="0" + i;
            }
            return i;
        }
    </script>
</body>
</html>
