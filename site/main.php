<?php 
    include_once 'functions.php';
    if (!isset($_GET['teacher'])) 
        header('Location: index.php');

    $teacherID = htmlentities($_GET['teacher']);
    if (!is_int(intval($teacherID)))
        header('Location: index.php');
    
    $teacher = json_decode(getData('personalData/'.$teacherID));
    $about = json_decode(getData('about/'.$teacherID));
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title><?php echo htmlentities($teacher->surname); ?></title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Responsive HTML5 Website landing Page for Developers">
    <meta name="author" content="3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico">  
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'> 
    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">   
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.css">
    <!-- github acitivity css -->
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/octicons/2.0.2/octicons.min.css">
    <link rel="stylesheet" href="http://caseyscarborough.github.io/github-activity/github-activity-0.1.0.min.css">
    
    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/styles.css">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head> 

<body>
    <!-- ******HEADER****** --> 
    <header class="header">
        <div class="container">
<!--            <div class="circular">-->
                <img  class="profile-image circular img-responsive pull-left" src="<?php echo htmlentities(SERVICE_URL.$about->photo); ?>" alt="<?php htmlentities($teacher->name) .'&nbsp;'.htmlentities($teacher->surname);?>" />
<!--            </div>-->
            <div class="profile-content pull-left">
                <h1 class="name"><?php echo htmlentities($teacher->name) .'&nbsp;'.htmlentities($teacher->surname);?></h1>
                <h2 class="desc"><?php echo htmlentities($teacher->title);?></h2>
            </div><!--//profile-->
            <a class="btn btn-success pull-right" data-target="#contactModal" data-toggle="modal"><i class="fa fa-paper-plane"></i> Contact Me</a>              
            
        </div><!--//container-->
    </header><!--//header-->
    
    <div class="container sections-wrapper">
        <div class="row">
            <div class="primary col-md-8 col-sm-12 col-xs-12">
                <section class="about section">
                    <div class="well  well-lg">
                            <h1 class="heading">About Me</h1>
                            
                        <div class="content">
                            <p><?php if ($about!=null) echo htmlentities($about->about); ?></p>
                    </div>
                </section>
                
    
               <section class="latest section">
                   <section class="projects section">
                   <div class="well well-lg">
                       <h1 class="heading">Projects</h1>
<?php $projects = json_decode(getData('projects/'.$teacherID)); ?>                       
                        <div class="content">
<?php foreach ($projects as $project) { ?>                            
                            <div class="item">
                                <h3 class="title">
                                    <a href="<?php echo htmlentities($project->link); ?>">
                                        <?php echo htmlentities($project->name); ?>
                                    </a>
                                </h3>
                                <p>
                                    <small>
                                        <?php echo htmlentities($project->comp); ?>
                                        &#44;&nbsp;
                                        <?php echo htmlentities(date("j/n/Y",strtotime($project->date_from))); ?>&nbsp; to &nbsp;
                                        <?php if ($project->current_project == 0) 
                                                echo htmlentities(date("j/n/Y",strtotime($project->date_to)));
                                              else
                                                  echo 'today<br />';
                                        ?>
                                        Members:&nbsp; <?php echo htmlentities($project->team_members); ?>
                                    </small>
                                </p>
                                <p class="summary"><?php echo htmlentities($project->description);?></p>
                                <?php if ($project->link != NULL && $project->link != "" ){ ?>
                                <p><a class="more-link" href="<?php echo htmlentities($project->link); ?>" target="_blank"><i class="fa fa-external-link"></i> Find out more</a></p>
                                <?php } ?>
                            </div>
                            <hr />
<?php } ?>
                        </div>
                   </div>
                   </section>
                   
                   <section class="experience section">
                    <div class="well well-sm">
                        <h1 class="heading">Work Experience</h1>
<?php $works = json_decode(getData('workingexperience/'.$teacherID)); ?>                        
                        <div class="content">
<?php foreach( $works as $work ){ ?>                            
                            <div class="item">
                                <h3 class="title">
                                    <?php echo htmlentities($work->title); ?>&nbsp;&minus;&nbsp;
                                    <span class="place">
                                        <a href="<?php echo htmlentities($work->compLink); ?>">
                                            <?php echo htmlentities($work->compName); ?>
                                        </a>
                                    </span>
                                    <span class="year">&#40;
                                        <?php echo htmlentities(date('m/Y',strtotime($work->timeperiod_from))); ?> 
                                        &nbsp;&minus;&nbsp;
                                        <?php echo ($work->current_job == 1) ? 'Current' : htmlentities(date('m/Y',strtotime($work->timeperiod_to)));?>&#41;
                                    </span>
                                </h3>
                                <p class="summary"><?php echo htmlentities($work->description); ?></p>
                            </div><!--//item-->
                            <hr />
                           <?php } ?>
                            
                        </div><!--//content-->  
                    </div><!--//section-inner-->                 
                </section><!--//section-->
                   
                   <section class="blog section">
                    <div class="well well-sm">
                        <h1 class="heading">News</h1>                      
                        <div class="content">
<?php $newslist = json_decode(getData('news/'.$teacherID)); 
    foreach($newslist as $news) {
?>                 
                            <div class="item">
                                <h4 class="heading text-center">
                                    <a data-toggle="collapse" data-target="#desc-<?php echo htmlentities($news->id);?>">
                                        <span class="pull-left"><?php echo date('j-M-Y',strtotime(htmlentities($news->date)));?></span>
                                        <span><?php echo htmlentities($news->title); ?></span>
<!--                                        <i class="glyphicon glyphicon-collapse-down pull-right">&nbsp;</i>-->
                                        <i class="fa fa-chevron-right pull-right">&nbsp;</i>
                                    </a>
                                </h4>
                                    <div id="desc-<?php echo htmlentities($news->id);?>" class="collapse">
                                <p class="summary">
                                    <?php echo htmlentities($news->description); ?>
                                </p>
                                <?php if ($news->file != NULL ) { ?>
                                <a href="<?php echo SERVICE_URL.htmlentities($news->file); ?>" 
                                   download="<?php $path_parts = pathinfo(htmlentities($news->file));
                                 echo $path_parts['basename']; ?>">
<!--                                    <i class="glyphicon glyphicon-download">&nbsp;</i>-->
                                    <i class="fa fa-download">&nbsp;</i>
<!--                                    <i class="glyphicon glyphicon-download-alt">&nbsp;</i>-->
                                    <?php echo $path_parts['basename'];?>
                                </a>
                                <?php } ?>
                                        </div>
                            </div><!--//item-->
                            <hr />
                           <?php } ?>
                            
                        </div><!--//content-->  
                    </div><!--//section-inner-->                 
                </section><!--//section-->
                 
            </div><!--//primary-->
            <div class="secondary col-md-4 col-sm-12 col-xs-12">
                 <aside class="info aside section">
                    <div class="well well-sm">
                        <h2 class="heading sr-only">Basic Information</h2>
                        <div class="content">
                            <ul class="list-unstyled">
<?php $info = json_decode(getData('basicInfo/' . $teacherID)); ?>                                
                                <li>
                                    <span class="sr-only">Location:</span>
                                    <address>
                                        <i class="glyphicon glyphicon-map-marker">&nbsp;</i>
                                        <a data-toggle="modal"  data-target="#mapModal">
                                        <?php echo htmlentities($info->street);?>&nbsp;
                                        <?php echo htmlentities($info->no); ?>&#44;&nbsp;
                                        <?php echo htmlentities($info->city); ?>&#44;&nbsp;
                                        <?php echo htmlentities($info->postal_code); ?>
                                            </a>
                                    </address>
                                </li>
                                <li>
                                    <span class="sr-only">Email:</span>
                                    <address>
                                        <i class="glyphicon glyphicon-envelope">&nbsp;</i>
                                        <a href="mailto:<?php echo htmlentities($info->email); ?>"><?php echo htmlentities($info->email); ?></a></li>
                                    </address>
<!--                                <li><i class="fa fa-link"></i><span class="sr-only">Website:</span><a href="#">http://www.website.com</a></li>-->
                            </ul>
                        </div><!--//content-->  
                    </div><!--//section-inner-->                 
                </aside><!--//aside-->

                    <aside class="education aside section">
                    <div class="well well-sm">
                        <h1 class="heading">Office Hours</h1>
                        <div class="content">
<?php $office_hours = json_decode(getData('office_hours/'.$teacherID));
    foreach ($office_hours as $hour) {
?>        
                            <div class="item">                      
                                <h3 class="title"> <?php echo htmlentities($hour->office).'&nbsp;in&nbsp;'.
        htmlentities($days[$hour->day]);?></h3>
                                <h4 class="university">
                                    <?php echo htmlentities($hour->hour_from).'&minus;'.
                                                    htmlentities($hour->hour_to); 
                                        ?>
                                        &nbsp;
                                </h4>
                            </div>
<?php } ?>                            
                            
                        </div><!--//content-->
                    </div><!--//section-inner-->
                </aside><!--//section-->
                    
                
                <aside class="education aside section">
                    <div class="well well-sm">
                        <h1 class="heading">Education</h1>
                        <div class="content">
<?php $education = json_decode(getData('education/'.$teacherID));
    foreach ($education as $edu) {
?>        
                            <div class="item">                      
                                <h3 class="title"><i class="fa fa-graduation-cap">&nbsp;</i> <?php echo htmlentities($edu->degreeName).'&nbsp;in&nbsp;'.
        htmlentities($edu->fieldOfStudy);?></h3>
                                <h4 class="university">
                                    <i class="fa fa-link">&nbsp;</i>
                                    <a href="<?php echo htmlentities($edu->link);?>" target="_blank">
                                        <?php echo htmlentities($edu->schoolName); ?>
                                    </a>&nbsp;
                                    <span class="year">&#40;
                                        <?php echo htmlentities(date('Y',strtotime($edu->attended_from))).'&minus;'.
                                                    htmlentities(date('Y',strtotime($edu->attended_to))); 
                                        ?>&nbsp;&#41;
                                    </span>
                                </h4>
                            </div>
<?php } ?>                            
                            
                        </div><!--//content-->
                    </div><!--//section-inner-->
                </aside><!--//section-->
                            
                <aside class="languages aside section">
                    <div class="well well-sm">
                        <h1 class="heading">Languages</h1>
                        <div class="content">
                            <ul class="list-unstyled">
<?php $langs = json_decode(getData('languages/'.$teacherID));
    foreach ($langs as $lang) {
?>
                                <li class="item">
                                    <span class="title"><strong><?php echo htmlentities($lang->name);?>&#58;</strong></span>
                                    <span class="level">
                                        <?php echo htmlentities($lang->levelname);?> 
                                        <br class="visible-xs"/>&nbsp;
                                        <?php for ($i=0; $i<intval($lang->level_id); $i++){ ?>
                                            <i class="fa fa-star">&nbsp;</i>
                                        <?php } ?>
                                    </span>
                                </li><!--//item-->
<?php } ?>                                
                            </ul>
                        </div><!--//content-->
                    </div><!--//section-inner-->
                </aside><!--//section-->
                
<!--
                <aside class="blog aside section">
                    <div class="well well-sm">
                        <h1 class="heading">News</h1>
<?php $newslist = json_decode(getData('news/'.$teacherID)); 
    foreach($newslist as $news) {
?>
                        <div class="item">
                            <h4 class="heading"><?php echo htmlentities($news->title); ?></h4>
                            <div>
                                <p class="summary"><?php echo htmlentities($news->description); ?></p>
                                <?php if ($news->file != NULL ) { ?>
                                <a href="<?php echo SERVICE_URL.htmlentities($news->file); ?>" 
                                   download="<?php $path_parts = pathinfo(htmlentities($news->file));
                                 echo $path_parts['basename']; ?>">
                                    <i class="fa fa-download">&nbsp;</i>
                                    <?php echo $path_parts['basename'];?>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
<?php } ?>    
                    </div>
                </aside>
-->
                
                    <aside class="education aside section">
                    <div class="well well-sm">
                        <h1 class="heading">Courses</h1>
                        <div class="content">
<?php $courses = json_decode(getData('courses_school/'.$teacherID));
    foreach ($courses as $course) {
?>        
                            <div class="item">                      
                                <h3 class="title">
                                    <i class="fa fa-files-o">&nbsp;</i><a data-toggle="collapse" data-target="#course-<?php echo htmlentities($course->id); ?>"><i class="fa fa-chevron-right pull-right">&nbsp;</i> <?php if ($course->code != NULL && $course->code != "") { echo htmlentities($course->code).'&nbsp;&minus;&nbsp;';}?><?php echo htmlentities($course->title);?></a>
                                </h3>
                                <div class="collapse" id="course-<?php echo htmlentities($course->id); ?>">
                                    <h4 class="university">
                                            
<!--
                                        <br />
                                            <span>
                                                    Code&#58;&nbsp; <?php echo htmlentities($course->code); ?> 
                                                    </br>
                                            </span>
-->
                                       <span>
                                                <i class="fa fa-link"> &nbsp;</i><a href="<?php echo htmlentities($course->link); ?>" target="_blank">
                                           <?php echo htmlentities($course->schoolname); ?>
                                           </a> </br>
                                        </span>
                                        <?php if ($course->co_teachers != NULL && $course->co_teachers != "") { ?>
                                            <span>
                                                    Co-Teachers&#58;&nbsp; <?php echo htmlentities($course->co_teachers); ?> 
                                                    </br>
                                            </span>
                                        <?php } ?>
                                        <span>
                                                    <?php echo htmlentities($course->review);?> 
                                                    </br>
                                        </span>
                                        </br>
                                        <?php if ($course->courses_current == 0 ) {?>
                                        <br />
                                        <span class="year">
                                            Teaching Period&#58;&nbsp;
                                            <?php echo htmlentities(date('j/m/Y',strtotime($course->courses_from))).'&nbsp;&minus;&nbsp;'.
                                                        htmlentities(date('j/m/Y',strtotime($course->courses_to))); 
                                            ?>
                                        </span>
                                        <?php }
                                        else if ($course->courses_current == 1) {?>
                                        <br />
                                        <span class="year">
                                            Teaching Period&#58;&nbsp;
                                            <?php echo htmlentities(date('j/m/Y',strtotime($course->courses_from))).'&nbsp;&minus;&nbsp;'.
                                                        'Current' 
                                            ?>
                                        </span>
                                        <?php }
                                        
                        ?>
                                        
                                    </h4>
                                </div>
                            </div>
<?php } ?>                            
                            
                        </div><!--//content-->
                    </div><!--//section-inner-->
                </aside><!--//section-->

                    
                    
                <aside class="education aside section">
                    <div class="well well-sm">
                        <h1 class="heading">Certifications</h1>
                        <div class="content">
<?php $certs = json_decode(getData('certifications/'.$teacherID));
    foreach ($certs as $cert) {
?>        
                            <div class="item">                      
                                <h3 class="title">
                                    <i class="fa fa-certificate">&nbsp;</i><a data-toggle="collapse" data-target="#cert-<?php echo htmlentities($cert->id); ?>"><i class="fa fa-chevron-right pull-right">&nbsp;</i> <?php echo htmlentities($cert->name);?></a>
                                </h3>
                                <div class="collapse" id="cert-<?php echo htmlentities($cert->id); ?>">
                                    <h4 class="university">
    <!--                                    <i class="fa fa-link">&nbsp;</i>-->
    <!--                                    <a href="<?php echo htmlentities($cert->link);?>" target="_blank">-->
                                            <?php echo htmlentities($cert->authority); ?>
    <!--                                    </a>&nbsp;-->
                                        <?php if ($cert->licenseno != NULL && $cert->licenseno != "") { ?>
                                        <br />
                                            <span>
                                                    License Number&#58;&nbsp; <?php echo htmlentities($cert->licenseno); ?>
                                            </span>
                                        <?php } ?>
                                        <?php if ($cert->does_not_expire == 0 ) {?>
                                        <br />
                                        <span class="year">
                                            Valid Period&#58;&nbsp;
                                            <?php echo htmlentities(date('j/m/Y',strtotime($cert->date_from))).'&nbsp;&minus;&nbsp;'.
                                                        htmlentities(date('j/m/Y',strtotime($cert->date_to))); 
                                            ?>
                                        </span>
                                        <?php } ?>
                                        <?php if ($cert->link != NULL & $cert->link != "") { ?>
                                            <br />
                                            <i class="fa fa-link">&nbsp;</i>
                                            <a href="<?php echo htmlentities($cert->link);?>" target="_blank">
                                                More...
                                            </a>
                                        <?php } ?>
                                    </h4>
                                </div>
                            </div>
<?php } ?>                            
                            
                        </div><!--//content-->
                    </div><!--//section-inner-->
                </aside><!--//section-->
                    
                    <aside class="education aside section">
                    <div class="well well-sm">
                        <h1 class="heading">Honors &amp; Awards</h1>
                        <div class="content">
<?php $honors = json_decode(getData('honors/'.$teacherID));
    foreach ($honors as $honor) {
?>        
                            <div class="item">                      
                                <h3 class="title">
                                    <i class="fa fa-trophy">&nbsp;</i><a data-toggle="collapse" data-target="#honor-<?php echo htmlentities($honor->id); ?>"><i class="fa fa-chevron-right pull-right">&nbsp;</i> <?php echo htmlentities($honor->title);?></a>
                                </h3>
                                <div class="collapse" id="honor-<?php echo htmlentities($honor->id); ?>">
                                    <h4 class="university">
                                            <?php echo htmlentities($honor->issuer); ?>
                                        
                                            <?php echo htmlentities(date('j/m/Y',strtotime($honor->date))); ?>
                                            <br />
                                            <p class="summary">
                                                <?php echo htmlentities($honor->description); ?>
                                            </p>
                                    </h4>
                                </div>
                            </div>
<?php } ?>                            
                            
                        </div><!--//content-->
                    </div><!--//section-inner-->
                </aside><!--//section-->


<aside class="education aside section">
                    <div class="well well-sm">
                        <h1 class="heading">Organizations</h1>
                        <div class="content">
<?php $organizations = json_decode(getData('organizations/'.$teacherID));
    foreach ($organizations as $organization) {
?>        
                            <div class="item">                      
                                <h3 class="title">
                                    <i class="fa fa-group">&nbsp;</i><a data-toggle="collapse" data-target="#organization-<?php echo htmlentities($organization->id); ?>"><i class="fa fa-chevron-right pull-right">&nbsp;</i> <?php echo htmlentities($organization->name);?></a>
                                </h3>
                                <div class="collapse" id="organization-<?php echo htmlentities($organization->id); ?>">
                                    <h4 class="university">
                                            <?php echo htmlentities($organization->position); ?>
                                            <br />
                                            <p class="summary">
                                                <?php echo htmlentities($organization->description); ?>
                                            </p>
                                        <?php if ($organization->current_position == 0 ) {?>
                                        <br />
                                        <span class="year">
                                            Period&#58;&nbsp;
                                            <?php echo htmlentities(date('j/m/Y',strtotime($organization->date_from))).'&nbsp;&minus;&nbsp;'.
                                                        htmlentities(date('j/m/Y',strtotime($organization->date_to))); 
                                            ?>
                                        </span>
                                        <?php }
                                        else if ($organization->current_position == 1) {?>
                                        <br />
                                        <span class="year">
                                            Period&#58;&nbsp;
                                            <?php echo htmlentities(date('j/m/Y',strtotime($organization->date_from))).'&nbsp;&minus;&nbsp;'.
                                                        'Current' 
                                            ?>
                                        </span>
                                        <?php }
                                        
                        ?>
                                    </h4>
                                </div>
                            </div>
<?php } ?>                            
                            
                        </div><!--//content-->
                    </div><!--//section-inner-->
                </aside><!--//section-->


                    <aside class="education aside section">
                    <div class="well well-sm">
                        <h1 class="heading">Publications</h1>
                        <div class="content">
<?php $publications = json_decode(getData('publications/'.$teacherID));
    foreach ($publications as $pub) {
?>        
                            <div class="item">                      
                                <h3 class="title">
                                    <i class="fa fa-book">&nbsp;</i><a data-toggle="collapse" data-target="#pub-<?php echo htmlentities($pub->id); ?>"><i class="fa fa-chevron-right pull-right">&nbsp;</i> <?php echo htmlentities($pub->title);?></a>
                                </h3>
                                <div class="collapse" id="pub-<?php echo htmlentities($pub->id); ?>">
                                    <h4 class="university">
                                         <?php echo htmlentities(date('j/m/Y',strtotime($pub->date))); ?>
                                        <br />
                                        <p class="summary">
                                            Publisher&#58;&nbsp;<?php echo htmlentities($pub->publisher); ?>
                                            <br />
                                            Authors&#58;&nbsp;<?php echo htmlentities($pub->authors); ?>
                                            <br />
                                        </p>
                                        <p class="summary">
                                            <?php echo htmlentities($pub->description); ?>
                                        </p>
                                        <?php if ($pub->link != NULL & $pub->link != "") { ?>
                                            <br />
                                            <i class="fa fa-link">&nbsp;</i>
                                            <a href="<?php echo htmlentities($pub->link);?>" target="_blank">
                                                More...
                                            </a>
                                        <?php } ?>
                                    </h4>
                                </div>
                            </div>
<?php } ?>                            
                            
                        </div><!--//content-->
                    </div><!--//section-inner-->
                </aside><!--//section-->
                    
                    
                <aside class="education aside section">
                    <div class="well well-sm">
                        <h1 class="heading">Interests</h1>
                        <div class="content">
<?php $interests = json_decode(getData('interests/'.$teacherID));
    foreach ($interests as $interest) {
?>        
                            <div class="item">                      
                                <p class="summary">
                                    <i class="fa fa-thumbs-o-up">&nbsp;</i>
                                    <p class="text-success"><?php echo htmlentities($interest->description);?></p>
                                </p>
                            </div>
<?php } ?>                            
                            
                        </div><!--//content-->
                    </div><!--//section-inner-->
                </aside><!--//section-->


              
            </div><!--//secondary-->    
        </div><!--//row-->
    </div><!--//masonry-->
            
    <div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <iframe width="100%" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
            src="https://maps.google.gr/maps?f=q&source=s_q&hl={{language}}&geocode=&q=<?php echo htmlentities($info->street) .','.
                                             htmlentities($info->no).','.
                                             htmlentities($info->city).','.
                                            htmlentities($info->postal_code);?>
            &aq=t&ie=UTF8&hq=&hnear=<?php echo htmlentities($info->street) .','.
                                             htmlentities($info->no).','.
                                             htmlentities($info->city).','.
                                            htmlentities($info->postal_code);?>&t=m&z=14&output=embed">
        </iframe>
        </div>
      </div>
    </div>
        
    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Drop me a Line</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8">
                                <form role="form">
                                    <div class="form-group has-feedback has-error">
                                        <label for="name" class="control-label">Name (required)</label>
                                        <input type="text" class="form-control tovalidate input-sm" required id="name" />
                                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                        <p class="help-block">Your name cannot be empty.</p>
                                    </div>
                                    
                                    <div class="form-group has-feedback has-error">
                                        <label for="email" class="control-label">Your Email (required)</label>
                                        <input type="email" class="form-control tovalidate input-sm" required id="email" />
                                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                        <p class="help-block">Your email must be a valid email.</p>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <label for="subject" class="control-label">Subject</label>
                                        <input type="text" class="form-control input-sm" required id="subject" />
                                    </div>
                                    
                                    
                                    <div class="form-group has-feedback">
                                        <label for="msg" class="control-label">Your Message</label>
                                        <textarea id="msg" class="form-control" rows="5"></textarea>                                        
                                        <span class="glyphicon glyphicon-ok form-control-feedback"></span>
                                    </div>
                                    
                                </form>
                            </div>
                            <div class="col-md-4">
                                <section id="addressSection">
                                    <h3>Addresses</h3>
                                    <ul>
<?php $adds = json_decode(getData("addresses/".$teacherID)); 
    foreach ($adds as $addr) {
?><li>
                                    <address>
                                        <?php if ($addr->primary_address == 1) { ?>
                                            <em>
                                        <?php } ?>
                                        <?php echo htmlentities($info->street) . '&nbsp;' .
                                              htmlentities($info->no) .'&#44;&nbsp;' .
                                              htmlentities($info->city) .' &#44;&nbsp;' .
                                              htmlentities($info->postal_code);
                                                    
                                            if ($addr->primary_address == 1) { ?>
                                            </em>
                                        <?php } ?>
                                    </address></li>
<?php } ?>                                    
                                        </ul>
                                </section>
                                <hr />
                                
                                <section id="phoneSection">
                                    <h3>Phones</h3>
                                    <ul>
<?php $tels = json_decode(getData('phones/'.$teacherID));
        foreach($tels as $tel ){
?>
                                        <li>
                                    <address>
<?php switch ($tel->type) {
            case 0: ?>
                                        <i class="fa fa-home">&nbsp;</i>
<?php           break;
            case 1: ?>
                                        <i class="fa fa-briefcase">&nbsp;</i>
<?php           break;
            case 2: ?>
                                        <i class="fa fa-mobile">&nbsp;</i>
<?php           break;
        } ?>
                                        <small>
                                        <?php echo htmlentities($tel->phone);?> 
                                        </small>
                
                                    </address>
                                            
                                            </li>
<?php } ?>                                  
                                        </ul>
                                </section>
                                <hr />
                                <section id="emailSection">
                                    <h3>Emails</h3>
                                    <ul>
<?php $emails = json_decode(getData('emails/'.$teacherID));
    foreach($emails as $email){
?>
                                    <li>
                                        <address>
                                            <?php if ($email->primary_mail == 1) { ?>
                                                <em>
                                            <?php }
                                            echo htmlentities($email->email);
                                                if ($email->primary_mail == 1) { ?>
                                                </em>
                                            <?php } ?>
                                        </address>
                                    </li>
<?php } ?>                                        
                                    </ul>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id='send' type="button" class="btn btn-primary">Send</button>
                </div>
            </div>
        </div>
    </div>
        
    

    <!-- ******FOOTER****** --> 
    <footer class="footer">
        <div class="container text-center">
                <small class="copyright">Designed with <i class="fa fa-heart"></i> by rousojohn & xna </small>
        </div><!--//container-->
    </footer><!--//footer-->
 
    <!-- Javascript -->          
    <script type="text/javascript" src="assets/plugins/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="assets/plugins/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- custom js -->
    <script type="text/javascript" src="assets/js/main.js"></script>            
</body>
</html> 

