<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>JIGU</title>
<link rel="stylesheet" type="text/css" href="../resource/css/menubar.css">
<link rel="stylesheet" type="text/css" href="../resource/css/index.css">
<link rel="stylesheet" type="text/css" href="../resource/css/common.css">

</head>
<body>
	<header>
    	<?php include "../resource/menubar.php";?>
    </header>
	<wrapper>
	    <?php include "main.php";?>
	</wrapper>
	<footer>
    	<?php include "../resource/footer.php";?>
    </footer>
</body>
<style>
body{background: #F0dddd !important;}
#main_content { height: 550px; margin: 0 auto; text-align: center;}
#main_content h1 {padding: 10px; text-align: display: block;}

#mboard{ float: left; width: 600px;}
#mboard h4 { width: 550px; font-size: 16px; padding-top: 10px; padding-bottom: 10px; border-bottom: solid 1px #dddddd; }
#mboard ul { margin-top: 20px; }
#mboard li { margin-top: 8px; margin-left: 10px; }
#mboard span { display: inline-block; }
#mboard span:nth-child(1) { width: 280px; }
#mboard span:nth-child(2) { width: 100px; }
#mboard span:nth-child(3) { width: 100px; }

#mrank{ float: left; width: 600px;}
#mrank h4 { width: 600px; font-size: 16px; padding-top: 10px; padding-bottom: 5px; border-bottom: solid 1px #dddddd; }
#mrank ul { margin-top: 20px; }
#mrank li { margin-top: 8px; margin-left: 10px; }
#mrank span { display: inline-block; }
#mrank span:nth-child(1) { width: 100px; }
#mrank span:nth-child(2) { width: 100px; }
#mrank span:nth-child(3) { width: 100px; }
#mrank span:nth-child(4) { width: 100px; }
</style>
</html>
