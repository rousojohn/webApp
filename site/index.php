<?php include_once 'functions.php' ?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>Teacher List</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Responsive HTML5 Website landing Page for Developers">
    <meta name="author" content="3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico">  
    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">   
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.css">
    <!-- github acitivity css -->
    
    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/styles1.css">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head> 

<body>

<div class="container" id="main">
	<div class="row">
        <?php $teachers = json_decode(getData('thumbnails'));
            foreach ($teachers as $teacher ) {            
        ?>
<!--     PHP for loop        -->
        <div class="col-sm-4">
            <div class="panel panel-default">
                <a href="main.php?teacher=<?php echo htmlentities($teacher->id) ?>">
                <div class="panel-thumbnail">
                    
                    <img src="<?php echo htmlentities(SERVICE_URL.$teacher->photo); ?>" class="img-responsive" />
                </div>
                <div class="panel-body">
                    <p class="lead"><?php echo htmlentities($teacher->surname) . " " .htmlentities($teacher->name); ?> </p>
                    <p><?php echo htmlentities($teacher->title);?></p>
                    
                </div>
                    </a>
            </div>
        </div><!--/col-->
        <?php } ?>
  </div><!--/main row-->
</div><!--/main-->

                 
</body>
</html> 

