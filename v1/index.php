<?php
session_start();
require 'mysql.php';

$connected = false;

if (isset($_GET["logout"])) {
    unset($_SESSION["sess"]);
}

if (!isset($_GET["code"])) {
    $_SESSION["sess"] = substr(md5(time()), 0, 5);
    mysql_query("INSERT INTO my_table (id, code, status) VALUES('','" . $_SESSION["sess"] . "', 0)") or DIE(mysql_error());
}

if (isset($_GET["code"])) {
    $query = "UPDATE my_table SET status = 1 WHERE code = '" . $_GET["code"] . "'";
    mysql_query($query) or DIE(mysql_error());
    $connected = true;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta content="IE=edge;chrome=1" http-equiv="X-UA-Compatible">        
        <meta name="format-detection" content = "telephone=no">        
        <meta name="description" content="Jan Jarčík"/>
        <meta name="keywords" content="Jan Jarčík" />
        <meta name="robots" content="index, follow" />
        <meta name="author" content="Jan Jarčík"/>
        <link href="./public/css/default.css" type ="text/css" media ="all" rel="stylesheet" />
        <link href="./public/css/style.css" type ="text/css" media ="all" rel="stylesheet" />

        <!-- Pulled from http://code.google.com/p/html5shiv/ -->
        <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->



        <title>V1 - synchro</title>
    </head>
    <body>
        <script type="text/javascript" src="js/jquery-1.10.1.min.js"></script> 

        <?php if (!$connected) { ?>  
            <div id="main">
                <h1>
                    Open this link in your mobile:
                </h1>
                <br />
                <br />
                <h2>
                    http://<?php echo $_SERVER['SERVER_NAME'] ?>/v1/<?php echo $_SESSION["sess"]; ?>
                </h2>
                <a href="./index.php?logout=1">Vygenerovat nový kód</a>
            </div>
        
        

            <div id ="server"></div>                   
            <script type="text/javascript" src="./public/js/js.js"></script>

        <?php } else { ?>
            
            <script type="text/javascript" src="./public/js/mobile.js"></script>
            <script type="text/javascript">
                code = "<?php echo $_GET["code"]; ?>";
            </script>
            <textarea></textarea>
        <?php } ?>

    </body>




</html>
