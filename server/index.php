<?php

require 'Slim/Slim.php';

define("HOST", "localhost");	// the server hosting the db
 define("USER", "teacherPageAdmin");	// db username
 define("PASSWORD","1");		// db password
 define("DATABASE", "teacherdb");

// initialize slim
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

// set response headers
$app->response->headers->set('Access-Control-Allow-Origin', '*');
$app->response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, OPTIONS');
$app->response->headers->set('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');

// allow OPTIONS response
$app->map('/:x+', function($x) {
    http_response_code(200);
})->via('OPTIONS');

// setup logger
$env = $app->environment();
$env['slim.errors'] = fopen( 'log.txt', 'a' );

// GET routes
//$app->get('/courses', 'getCourses');
$app->get('/courses/:user_id',  'getCourse');
$app->get('/news', 'getNews');
//$app->get('/news/:id',  'getNewsById');
$app->get('/news/:user_id', 'getNewsFromUser');
$app->get('/news/:user_id/:id', 'getSpecifiedNewsFromUser');
$app->get('/certifications/:user_id', 'getCertificationsFromUser');
$app->get('/certifications/:user_id/:id', 'getSpecifiedCertificationFromUser');
$app->get('/honors/:user_id', 'getHonorsFromUser');
$app->get('/honors/:user_id/:id', 'getSpecifiedHonorFromUser');
$app->get('/companies/:user_id', 'getCompaniesFromUser');
$app->get('/education/:user_id', 'getEducationFromUser');
$app->get('/interests/:user_id', 'getInterestsFromUser');
$app->get('/interests/:user_id/:id', 'getSpecifiedInterestFromUser');
$app->get('/languages/:user_id', 'getLanguagesFromUser');
$app->get('/organizations/:user_id', 'getOrganizationsFromUser');
$app->get('/projects/:user_id', 'getProjectsFromUser');
$app->get('/projects/:user_id/:id', 'getSpecifiedProjectFromUser');
$app->get('/publications/:user_id', 'getPublicationsFromUser');
$app->get('/publications/:user_id/:id', 'getSpecifiedPublicationFromUser');
$app->get('/schools/:user_id', 'getSchoolsFromUser');
$app->get('/workingexperience/:user_id', 'getWorkingExperienceFromUser');
$app->get('/personalData/:user_id', 'getPersonalData');
$app->get('/addresses/:user_id', 'getUserAddresses');
$app->get('/degree/:id', 'getDegree');
$app->get('/degree', 'getDegrees');
$app->get('/levels/:id', 'getLevel');
$app->get('/levels' , 'getLevels');
$app->get('/emails/:user_id', 'getUserEmails');
$app->get('/phones/:user_id', 'getPhones');
$app->get('/office_hours/:user_id', 'getUserOfficeHours');
$app->get('/user/:id', 'getUsername');
$app->get('/about/:user_id', 'getAboutMe');
$app->get('/courses_school/:user_id','getSchoolFromCourse');
$app->get('/thumbnails', 'getThumbnails');
$app->get('/basicInfo/:user_id', 'getUserInfo');

// POST routes
$app->post('/login', 'login');
//$app->post('/questions', 'postQuestions');
$app->post('/courses/:user_id', 'addCourse');
$app->post('/news/:user_id', 'addNews'); 
$app->post('/education/:user_id', 'addEducation');
$app->post('/certifications/:user_id', 'addCertification');
$app->post('/companies/:user_id', 'addCompany');
$app->post('/honors/:user_id', 'addHonors');
$app->post('/interests/:user_id', 'addInterest');
$app->post('/languages/:user_id', 'addLanguage');
$app->post('/organizations/:user_id', 'addOrganization');
$app->post('/phones/:user_id', 'addPhone');
$app->post('/addresses', 'addAddress');
$app->post('/projects/:user_id', 'addProject');
$app->post('/publications/:user_id', 'addPublication');
$app->post('/schools/:user_id', 'addSchool');
$app->post('/workingexperience/:user_id', 'addWorkingExperience');
$app->post('/personalData/:user_id', 'addPersonalData');
$app->post('/addresses/:user_id', 'addAddresses');
$app->post('/degree','addDegree');
//$app->post('/levels','addLevel');
$app->post('/emails/:user_id', 'addEmails');
$app->post('/office_hours/:user_id', 'addOfficeHours');

$app->post('/uploadFile/:user_id', 'uploadFile');
$app->post('/about/:user_id', 'addAboutMe');




// PUT routes
$app->put('/news/:user_id/:id', 'updateNews');
$app->put('/courses/:user_id/:id', 'updateCourses');
$app->put('/education/:user_id/:id', 'updateEducation'); 
$app->put('/certifications/:user_id/:id', 'updateCertification');
$app->put('/companies/:user_id/:id', 'updateCompany');
$app->put('/honors/:user_id/:id', 'updateHonors');
$app->put('/interests/:user_id/:id', 'updateInterest');
$app->put('/languages/:user_id/:id', 'updateLanguage'); 
$app->put('/organizations/:user_id/:id', 'updateOrganization');
$app->put('/phones/:user_id/:id', 'updatePhone'); 
$app->put('/addresses/:user_id/:id', 'updateAddress');
$app->put('/projects/:user_id/:id', 'updateProject');
$app->put('/publications/:user_id/:id', 'updatePublication');
$app->put('/schools/:user_id/:id', 'updateSchool');
$app->put('/workingexperience/:user_id/:id', 'updateWorkingExperience');
$app->put('/personalData/:user_id/:id', 'updatePersonalData');
$app->put('/emails/:user_id/:id', 'updateEmail');
$app->put('/office_hours/:user_id/:id', 'updateOfficeHours');
$app->put('/about/:user_id/:id', 'updateAbout');



// DELETE routes

$app->delete('/courses/:user_id/:id', 'deleteCourses');
$app->delete('/education/:user_id/:id', 'deleteEducation');
$app->delete('/certifications/:user_id/:id', 'deleteCertification');
$app->delete('/companies/:user_id/:id', 'deleteCompany');
$app->delete('/honors/:user_id/:id', 'deleteHonors');
$app->delete('/interests/:user_id/:id', 'deleteInterest');
$app->delete('/languages/:user_id/:id', 'deleteLanguage');
$app->delete('/organizations/:user_id/:id', 'deleteOrganization');
$app->delete('/phones/:user_id/:id', 'deletePhone');
$app->delete('/addresses/:user_id/:id', 'deleteAddress');
$app->delete('/projects/:user_id/:id', 'deleteProject');
$app->delete('/publications/:user_id/:id', 'deletePublication');
$app->delete('/schools/:user_id/:id', 'deleteSchool');
$app->delete('/workingexperience/:user_id/:id', 'deleteWorkingExperience');
$app->delete('/personalData/:user_id/:id', 'deletePersonalData');
$app->delete('/news/:user_id/:id', 'deleteNews');
$app->delete('/emails/:user_id/:id', 'deleteEmail');
$app->delete('/office_hours/:user_id/:id', 'deleteOfficeHours');

$app->run();

function getConnection() {
	return new PDO('mysql:host='.HOST.';dbname='.DATABASE.';charset=utf8', USER, PASSWORD, array(PDO::ATTR_EMULATE_PREPARES => false, 
                                                                                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

// Send error to the client
function reportError($msg){
	$result = new stdClass();
	$result->success = false;
	$result->error = $msg;
	echo json_encode($result);
}

// Log error to the server
function logError($ex){
	$request = \Slim\Slim::getInstance()->request;
	$log =  \Slim\Slim::getInstance()->getLog();
	$fullError = "";
    $log->error( date("Y-m-d H:i:s") . "\t" . $request->getMethod() . "\t" . getCaller() . "\t" . $request->getBody() . "\t" . $ex->getMessage());
}

// Get the name of the calling custom method
function getCaller() {
    $trace = debug_backtrace();
    $name = $trace[3]['function'];
    return empty($name) ? 'global' : $name;
}

function getCourses() {
    $sql = "select * FROM tbl_courses ORDER BY title";
    //$result = new stdClass();
    try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $courses = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //$courses->success = true;
        echo json_encode($courses);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get Courses");
    }
}

function getCourse($user_id) {
    $sql = "SELECT * FROM tbl_courses WHERE user_id=:user_id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();
        $courses = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //$courses->success = true;
        echo json_encode($courses);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get specified Course");
    }
}

function getSchoolFromCourse($user_id) {
    $sql = "SELECT s.*, c.name as schoolname, c.link FROM tbl_school as c inner join tbl_courses as s on c.id = s.school_id WHERE c.user_id=:user_id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();
        $courses = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //$courses->success = true;
        echo json_encode($courses);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get specified Course");
    }
}

function getNews() {
    $sql = "select * FROM tbl_news ORDER BY date DESC";
    $toReturn = new stdClass();
    try {
        $db = getConnection();
        $stmt = $db->query($sql);
        //$toReturn->success = true;
        $news = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($news);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get News");
    }
}

function getNewsById($id) {
    $sql = "SELECT * FROM tbl_news WHERE id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $news = $stmt->fetchObject();
        
        echo json_encode($news);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get specified News");
    }
}

function getNewsFromUser($user_id) {
    $sql = "SELECT id, title, date, description, file, user_id, dayofmonth(date) as day, month(date) as month, year(date) as year FROM tbl_news WHERE user_id=:user_id ORDER BY date DESC";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();
        $news = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //$news->success = true;
        echo json_encode($news);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get news posted by this user");
    }
}

function getSpecifiedNewsFromUser($user_id,$id) {
 $sql = "SELECT * FROM tbl_news WHERE user_id=:user_id and id=:id ORDER BY date DESC";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $news = $stmt->fetchObject();//fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //$news->success = true;
        echo json_encode($news);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get specified news posted by this user");
    }
}    

function getCertificationsFromUser($user_id) {
    $sql = "SELECT * FROM tbl_certifications WHERE user_id=:user_id ORDER BY date_from DESC";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();
        $certifications = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //$certifications->success = true;
        echo json_encode($certifications);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get certifications for this user");
    }
}

function getSpecifiedCertificationFromUser($user_id,$id) {
 $sql = "SELECT * FROM tbl_certifications WHERE user_id=:user_id and id=:id ORDER BY date_from DESC";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $certifications = $stmt->fetchObject();//fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //$certifications->success = true;
        echo json_encode($certifications);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get specified certification for this user");
    }
}    

function getCompaniesFromUser($user_id) {
 $sql = "SELECT * FROM tbl_company WHERE user_id=:user_id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();
        $companies = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //$education->success = true;
        echo json_encode($companies);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get companies for this user");
    }
}

function getEducationFromUser($user_id) {
    $sql = "SELECT e.*, d.name as degreeName, s.name as schoolName, s.link FROM tbl_education as e inner join tbl_degree as d on e.degree_id = d.id inner join tbl_school as s on e.school_id = s.id WHERE e.user_id=:user_id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();
        $education = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //$education->success = true;
        echo json_encode($education);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get education for this user");
    }
}

function getHonorsFromUser($user_id) {
    $sql = "SELECT * FROM tbl_honors_awards WHERE user_id=:user_id ORDER BY date DESC";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();
        $honors = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //$honors->success = true;
        echo json_encode($honors);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get Honors-awards for this user");
    }
}

function getSpecifiedHonorFromUser($user_id,$id) {
 $sql = "SELECT * FROM tbl_honors_awards WHERE user_id=:user_id and id=:id ORDER BY date DESC";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $honors = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //$honors->success = true;
        echo json_encode($honors);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get specified honor-award for this user");
    }
}    

function getInterestsFromUser($user_id) {
    $sql = "SELECT * FROM tbl_interests WHERE user_id=:user_id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();
        $interests = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //$interests->success = true;
        echo json_encode($interests);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get interests for this user");
    }
}

function getSpecifiedInterestFromUser($user_id,$id) {
 $sql = "SELECT * FROM tbl_interests WHERE user_id=:user_id and id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $interests = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //$interests->success = true;
        echo json_encode($interests);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get specified interest for this user");
    }
}

function getLanguagesFromUser($user_id) {
    $sql = "SELECT l.*, le.name as levelname FROM tbl_languages as l inner join tbl_levels as le on le.id = l.level_id WHERE user_id=:user_id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();
        $languages = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //$languages->success = true;
        echo json_encode($languages);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get languages for this user");
    }
}

function getOrganizationsFromUser($user_id) {
    $sql = "SELECT * FROM tbl_organizations WHERE user_id=:user_id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();
        $organizations = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //$organizations->success = true;
        echo json_encode($organizations);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get organizations for this user");
    }
}

function getProjectsFromUser($user_id) {
//    $sql = "SELECT * FROM tbl_projects_research WHERE user_id=:user_id ORDER BY date_from DESC";
    $sql = "SELECT p.`id`, p.`name`, p.`description`, p.`date_from`, p.`date_to`, p.`current_project`, p.`team_members`, ifnull(p.`link`,'#') as link,
            ifnull(s.`name`, ifnull(p.`name`, '')) as comp , p.`user_id` 
            FROM `tbl_projects_research` as p 
            left join tbl_education as e on e.`id` = p.`education_id` 
            left join tbl_company as c on c.`id` = p.`company_id` 
            inner join tbl_school as s on s.`id` = e.`school_id`
            where p.`user_id`=:user_id
            order by p.`date_from` desc";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();
        $projects = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //$news->success = true;
        echo json_encode($projects);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get projects-research for this user");
    }
}

function getSpecifiedProjectFromUser($user_id,$id) {
 $sql = "SELECT * FROM tbl_projects_research WHERE user_id=:user_id and id=:id ORDER BY date_from DESC";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $projects = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //$projects->success = true;
        echo json_encode($projects);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get specified project-research for this user");
    }
}

function getPublicationsFromUser($user_id) {
    $sql = "SELECT * FROM tbl_publications WHERE user_id=:user_id ORDER BY date DESC";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();
        $publications = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //$publications->success = true;
        echo json_encode($publications);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get publications for this user");
    }
}

function getSpecifiedPublicationFromUser($user_id,$id) {
 $sql = "SELECT * FROM tbl_publications WHERE user_id=:user_id and id=:id ORDER BY date DESC";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $publications = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //$publications->success = true;
        echo json_encode($publications);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get specified publication for this user");
    }
}

function getSchoolsFromUser($user_id) {
    $sql = "SELECT * FROM tbl_school WHERE user_id=:user_id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();
        $schools = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //$schools->success = true;
        echo json_encode($schools);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get schools for this user");
    }
}

function getWorkingExperienceFromUser($user_id) {
//    $sql = "SELECT * FROM tbl_workingexperience WHERE user_id=:user_id ORDER BY timeperiod_from DESC";
    $sql = "SELECT w.`id`,w.`title`, w.`timeperiod_from`, w.`timeperiod_to`, w.`current_job`, w.`description`, w.`company_id`, w.`user_id`, c.`name` as compName, c.`link` as compLink FROM `tbl_workingexperience` as w inner join tbl_company as c on c.`id`=w.`company_id` where w.`user_id`=2 order by w.`timeperiod_from` desc";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();
        $workingexperience = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //$workingexperience->success = true;
        echo json_encode($workingexperience);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get working experience for this user");
    }
}



function getPersonalData ($user_id) {
    $sql = "select * from tbl_personalData where user_id=:user_id limit 1";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();
        $person = $stmt->fetchObject();
        $db = null;
        echo json_encode($person);
    }
    catch (PDOException $e) {
        logError($e);
    }
}


function getUserAddresses ($user_id) {
    $sql = "select * from tbl_addresses where user_id=:user_id";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();
        $addr = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($addr);
    }
    catch (PDOException $e) {
        logError($e);
        reportError("fetchErrorAddr");
    }
}

    
function getDegree($id) {
    $sql = "SELECT * FROM tbl_degree WHERE id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $degree = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //$degree->success = true;
        echo json_encode($degree);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get specified Degree");
    }
}


function getDegrees() {
    $sql = "SELECT * FROM tbl_degree";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $degree = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //$degree->success = true;
        echo json_encode($degree);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get specified Degree");
    }
}
    


function getLevels() {
    $sql = "select * from tbl_levels";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        
        $levels = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($levels);
    }
    catch (PDOException $e) {
        logError($e);
        reportError('fetchLevelsException');
    }
}

function getLevel($id) {
    $sql = "SELECT * FROM tbl_levels WHERE id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $levels = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //$levels->success = true;
        echo json_encode($levels);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get specified Level");
    }
}

function getUserEmails ($user_id) {
    $sql = "select * from tbl_emails where user_id=:user_id";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();
        $emails = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($emails);
    }
    catch (PDOException $e) {
        logError($e);
        reportError("Didn't get Emails from User");
    }
}


function getPhones ($user_id) {
    $sql = "select * from tbl_phones where user_id=:user_id";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();
        $phones = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($phones);
    }
    catch (PDOException $e) {
        logError($e);
    }
}

function getUserOfficeHours ($user_id) {
    $sql = "select * from office_hours where user_id=:user_id";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();
        $office_hours = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($office_hours);
    }
    catch (PDOException $e) {
        logError($e);
        reportError("Didn't get Office Hours from User");
    }
}

function getUsername($id) {
    $sql = "SELECT username FROM tbl_user WHERE id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $db = null;
        //$user->success = true;
        echo json_encode($user);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't get specified Username");
    }
}

function getAboutMe ($user_id) {
    $sql = "select * from tbl_about where user_id=:user_id limit 1";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();
        $about = $stmt->fetchObject();
        $db = null;
        echo json_encode($about);
    }
    catch (PDOException $e) {
        logError($e);
        reportError('AboutMeException');
    }
}

function getThumbnails () {
    $sql = "select ifnull(p.surname,'') as surname, ifnull(p.name, '') as name, ifnull(a.photo,'') as photo, ifnull(p.title, '') as title, u.id from tbl_personaldata as p left join tbl_about as a on p.user_id=a.user_id right join tbl_user as u on u.id = p.user_id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $teachers = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($teachers);
    }
    catch (PDOException $e){
        logError($e);
        reportError('fetchTeachersError');
    }
}


function getUserInfo($user_id) {
    $sql = "select a.street, a.no, a.city, a.postal_code, e.email
            from tbl_addresses as a 
            left join tbl_emails as e on e.user_id = a.user_id
            where a.primary_address = 1 and e.primary_mail=1 and a.user_id=:user_id limit 1";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam('user_id', $user_id);
        $stmt->execute();
        $info = $stmt->fetchObject();
        $db = null;
        echo json_encode($info);
    }
    catch (PDOException $e){
        logError($e);
        reportError('fetchInfoException');
    }
}
    


function addCourse($user_id) {
    $request = \Slim\Slim::getInstance()->request();
    $courses = json_decode($request->getBody());
    //var_dump($request->getBody());
    $sql = "INSERT INTO tbl_courses (code, title, review, courses_from, courses_to, courses_current, co_teachers, user_id, school_id) VALUES (:code, :title, :review, :courses_from, :courses_to, :courses_current, :co_teachers, :user_id, :school_id)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("code", $courses->code);
        $stmt->bindParam("title", $courses->title);
        $stmt->bindParam("review", $courses->review);
        $stmt->bindParam("courses_from", $courses->courses_from);
        $stmt->bindParam("courses_to", $courses->courses_to);
        $stmt->bindParam("courses_current", $courses->courses_current);
        $stmt->bindParam("co_teachers", $courses->co_teachers);
        $stmt->bindParam("user_id", $courses->user_id);
        $stmt->bindParam("school_id", $courses->school_id);
        $stmt->execute();
        $courses->id = $db->lastInsertId();
        //$courses->success = true;
        $db = null;
        echo json_encode($courses);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't add Course");
    }
}

function addDegree() {
    $request = \Slim\Slim::getInstance()->request();
    $degree= json_decode($request->getBody());
    //var_dump($request->getBody());
    $sql = "INSERT INTO tbl_degree (name) VALUES (:name)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("name", $degree->name);
        $stmt->execute();
        $degree->id = $db->lastInsertId();
        //$degree->success = true;
        $db = null;
        echo json_encode($degree);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't add Degree");
    }
}

function addLevel() {
    $request = \Slim\Slim::getInstance()->request();
    $levels= json_decode($request->getBody());
    $sql = "INSERT INTO tbl_levels (name) VALUES (:name)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("name", $levels->name);
        $stmt->execute();
        $levels->id = $db->lastInsertId();
        //$degree->success = true;
        $db = null;
        echo json_encode($levels);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't add Level");
    }
}

function addNews() {
    $request = \Slim\Slim::getInstance()->request();
    $news = json_decode($request->getBody());
//    var_dump($request->getBody());
    $sql = "INSERT INTO tbl_news (title, date, description, file, user_id) VALUES (:title, :date, :description, :file, :user_id)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("title", $news->title);
        $stmt->bindParam("date", $news->date);
        $stmt->bindParam("description", $news->description);
        $stmt->bindParam("file", $news->file);
        $stmt->bindParam("user_id", $news->user_id);
        $stmt->execute();
        $news->id = $db->lastInsertId();
        $db = null;
        //$news->success = true;
        echo json_encode($news);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't add News");
    }
}

function addEducation($user_id) {
    $request = \Slim\Slim::getInstance()->request();
    $education = json_decode($request->getBody());
    //var_dump($request->getBody());
    $sql = "INSERT INTO tbl_education (attended_from, attended_to, current_education, fieldOfStudy, grade, description, degree_id, school_id, user_id) VALUES (:attended_from, :attended_to, :current_education, :fieldOfStudy, :grade, :description, :degree_id, :school_id, :user_id)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("attended_from", $education->attended_from);
        $stmt->bindParam("attended_to", $education->attended_to);
        $stmt->bindParam("current_education", $education->current_education);
        $stmt->bindParam("fieldOfStudy", $education->fieldOfStudy);
        $stmt->bindParam("grade", $education->grade);
        $stmt->bindParam("description", $education->description);
        $stmt->bindParam("degree_id", $education->degree_id);
        $stmt->bindParam("school_id", $education->school_id);
        $stmt->bindParam("user_id", $education->user_id);
        $stmt->execute();
        $education->id = $db->lastInsertId();
        //$education->success = true;
        $db = null;
        echo json_encode($education);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't add Education");
    }
}

function addCertification($user_id) {
    $request = \Slim\Slim::getInstance()->request();
    $certifications = json_decode($request->getBody());
    $sql = "INSERT INTO tbl_certifications (name, description, authority, link, date_from, date_to, does_not_expire, licenseno, user_id) VALUES (:name, :description, :authority, :link, :date_from, :date_to, :does_not_expire, :licenseno, :user_id)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("name", $certifications->name);
        $stmt->bindParam("description", $certifications->description);
        $stmt->bindParam("authority", $certifications->authority);
        $stmt->bindParam("link", $certifications->link);
        $stmt->bindParam("date_from", $certifications->date_from);
        $stmt->bindParam("date_to", $certifications->date_to);
        $stmt->bindParam("does_not_expire", $certifications->does_not_expire);
        $stmt->bindParam("licenseno", $certifications->licenseno);
        $stmt->bindParam("user_id", $certifications->user_id);
        $stmt->execute();
        $certifications->id = $db->lastInsertId();
        $db = null;
        //$certifications->success = true;
        echo json_encode($certifications);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't add Certification");
    }
}

function addCompany($user_id) {
    $request = \Slim\Slim::getInstance()->request();
    $companies = json_decode($request->getBody());
    //var_dump($request->getBody());
    $sql = "INSERT INTO tbl_company (name, address, phone, link, user_id) VALUES (:name, :address, :phone, :link, :user_id)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("name", $companies->name);
        $stmt->bindParam("address", $companies->address);
        $stmt->bindParam("phone", $companies->phone);
        $stmt->bindParam("link", $companies->link);
        $stmt->bindParam("user_id", $companies->user_id);
        $stmt->execute();
        $companies->id = $db->lastInsertId();
        $db = null;
        //$companies->success = true;
        echo json_encode($companies);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't add Company");
    }
}


function addHonors($user_id) {
    $request = \Slim\Slim::getInstance()->request();
    $honors = json_decode($request->getBody());
    //var_dump($request->getBody());
    $sql = "INSERT INTO tbl_honors_awards (date, description, issuer, title, user_id) VALUES (:date, :description, :issuer, :title, :user_id)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("date", $honors->date);
        $stmt->bindParam("description", $honors->description);
        $stmt->bindParam("issuer", $honors->issuer);
        $stmt->bindParam("title", $honors->title);
        $stmt->bindParam("user_id", $honors->user_id);
        $stmt->execute();
        $honors->id = $db->lastInsertId();
        $db = null;
        //$honors->success = true;
        echo json_encode($honors);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't add Honor-Award");
    }
}

function addInterest($user_id) {
    $request = \Slim\Slim::getInstance()->request();
    $interests = json_decode($request->getBody());
    //var_dump($request->getBody());
    $sql = "INSERT INTO tbl_interests (description, user_id) VALUES (:description, :user_id)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("description", $interests->description);
        $stmt->bindParam("user_id", $interests->user_id);
        $stmt->execute();
        $interests->id = $db->lastInsertId();
        $db = null;
        //$interests->success = true;
        echo json_encode($interests);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't add Interest");
    }
}

function addLanguage($user_id) {
    $request = \Slim\Slim::getInstance()->request();
    $languages = json_decode($request->getBody());
    $sql = "INSERT INTO tbl_languages (name, level_id, user_id) VALUES (:name, :level_id, :user_id)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("name", $languages->name);
        $stmt->bindParam("level_id", $languages->level_id);
        $stmt->bindParam("user_id", $languages->user_id);
        $stmt->execute();
        $languages->id = $db->lastInsertId();
        $db = null;
        //$languages->success = true;
        echo json_encode($languages);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't add Language");
    }
}

function addOrganization($user_id) {
    $request = \Slim\Slim::getInstance()->request();
    $organizations = json_decode($request->getBody());
    //var_dump($request->getBody());
    $sql = "INSERT INTO tbl_organizations (name, position, date_from, date_to, current_position, description, user_id) VALUES (:name, :position, :date_from, :date_to, :current_position, :description, :user_id)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("name", $organizations->name);
        $stmt->bindParam("position", $organizations->position);
        $stmt->bindParam("date_from", $organizations->date_from);
        $stmt->bindParam("date_to", $organizations->date_to);
        $stmt->bindParam("current_position", $organizations->current_position);
        $stmt->bindParam("description", $organizations->description);
        $stmt->bindParam("user_id", $organizations->user_id);
        $stmt->execute();
        $organizations->id = $db->lastInsertId();
        $db = null;
        //$organizations->success = true;
        echo json_encode($organizations);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't add Organization");
    }
}
    
function addPhone() {
    $request = \Slim\Slim::getInstance()->request();
    $phones = json_decode($request->getBody());
    //var_dump($request->getBody());
    $sql = "INSERT INTO tbl_phones (phone, user_id, type) VALUES (:phone, :user_id, :type)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("phone", $phones->phone);
        $stmt->bindParam("user_id", $phones->user_id);
        $stmt->bindParam("type", $phones->type);
        $stmt->execute();
        $phones->id = $db->lastInsertId();
        $db = null;
        //$phones->success = true;
        echo json_encode($phones);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't add Phone");
    }
}

function addAddress() {
    $request = \Slim\Slim::getInstance()->request();
    $addresses = json_decode($request->getBody());
    //var_dump($request->getBody());
    $sql = "INSERT INTO tbl_addresses (street, primary_address, user_id, no, city, postal_code) VALUES (:street, :primary_address, :user_id, :no, :city, :postal_code)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("street", $addresses->street);
        $stmt->bindParam("primary_address", $addresses->primary_address);
        $stmt->bindParam("user_id", $addresses->user_id);
        $stmt->bindParam("no", $addresses->no);
        $stmt->bindParam("city", $addresses->city);
        $stmt->bindParam("postal_code", $addresses->postal_code);
        $stmt->execute();
        $addresses->id = $db->lastInsertId();
        $db = null;
        //$addresses->success = true;
        echo json_encode($addresses);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't add Address");
    }
}

function addProject($user_id) {
    $request = \Slim\Slim::getInstance()->request();
    $projects = json_decode($request->getBody());
    //var_dump($request->getBody());
    $sql = "INSERT INTO tbl_projects_research (name, description, date_from, date_to, current_project, team_members, link, company_id, education_id, user_id) VALUES (:name, :description, :date_from, :date_to, :current_project, :team_members, :link, :company_id, :education_id, :user_id)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("name", $projects->name);
        $stmt->bindParam("description", $projects->description);
        $stmt->bindParam("date_from", $projects->date_from);
        $stmt->bindParam("date_to", $projects->date_to);
        $stmt->bindParam("current_project", $projects->current_project);
        $stmt->bindParam("team_members", $projects->team_members);
        $stmt->bindParam("link", $projects->link);
        $stmt->bindParam("company_id", $projects->company_id);
        $stmt->bindParam("education_id", $projects->education_id);
        $stmt->bindParam("user_id", $projects->user_id);
        $stmt->execute();
        $projects->id = $db->lastInsertId();
        $db = null;
        //$projects->success = true;
        echo json_encode($projects);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't add Project");
    }
}

function addPublication($user_id) {
    $request = \Slim\Slim::getInstance()->request();
    $publications = json_decode($request->getBody());
    //var_dump($request->getBody());
    $sql = "INSERT INTO tbl_publications (title, date, link, publisher, authors, description, user_id) VALUES (:title, :date, :link, :publisher, :authors, :description, :user_id)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("title", $publications->title);
        $stmt->bindParam("date", $publications->date);
        $stmt->bindParam("link", $publications->link);
        $stmt->bindParam("publisher", $publications->publisher);
        $stmt->bindParam("authors", $publications->authors);
        $stmt->bindParam("description", $publications->description);
        $stmt->bindParam("user_id", $publications->user_id);
        $stmt->execute();
        $publications->id = $db->lastInsertId();
        $db = null;
        //$publications->success = true;
        echo json_encode($publications);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't add Publication");
    }
}

function addSchool($user_id) {
    $request = \Slim\Slim::getInstance()->request();
    $schools = json_decode($request->getBody());
    //var_dump($request->getBody());
    $sql = "INSERT INTO tbl_school (name, address, phone, link, user_id) VALUES (:name, :address, :phone, :link, :user_id)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("name", $schools->name);
        $stmt->bindParam("address", $schools->address);
        $stmt->bindParam("phone", $schools->phone);
        $stmt->bindParam("link", $schools->link);
        $stmt->bindParam("user_id", $schools->user_id);
        $stmt->execute();
        $schools->id = $db->lastInsertId();
        $db = null;
        //$schools->success = true;
        echo json_encode($schools);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't add School");
    }
}

function addWorkingExperience($user_id) {
    $request = \Slim\Slim::getInstance()->request();
    $workingexperience = json_decode($request->getBody());
    //var_dump($request->getBody());
    $sql = "INSERT INTO tbl_workingexperience (title, timeperiod_from, timeperiod_to, current_job, description, company_id, user_id) VALUES (:title, :timeperiod_from, :timeperiod_to, :current_job, :description, :company_id, :user_id)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("title", $workingexperience->title);
        $stmt->bindParam("timeperiod_from", $workingexperience->timeperiod_from);
        $stmt->bindParam("timeperiod_to", $workingexperience->timeperiod_to);
        $stmt->bindParam("current_job", $workingexperience->current_job);
        $stmt->bindParam("description", $workingexperience->description);
        $stmt->bindParam("company_id", $workingexperience->company_id);
        $stmt->bindParam("user_id", $workingexperience->user_id);
        $stmt->execute();
        $workingexperience->id = $db->lastInsertId();
        $db = null;
        //$workingexperience->success = true;
        echo json_encode($workingexperience);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't add Working Experience");
    }
}



function addAddresses () {
    $request = \Slim\Slim::getInstance()->request();
    $addr = json_decode($request->getBody());
    
    $sql = "insert into tbl_addresses (street, primary_address, user_id, no, city, postal_code) values
            (:street, :primary_address, :user_id, :no, :city, :postal_code)";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("street", $addr->street);
        $stmt->bindParam("primary_address", $addr->primary_address);
        $stmt->bindParam("user_id", $addr->user_id);
        $stmt->bindParam("no", $addr->no);
        $stmt->bindParam("city", $addr->city);
        $stmt->bindParam("postal_code", $addr->postal_code);
        $stmt->execute();
        $addr->id = $db->lastInsertId();
        $db = null;
        //$workingexperience->success = true;
        echo json_encode($addr);
    } catch(PDOException $e) {
        logError($e);
        reportError("AddErrorAddr");
    }
}


function addPersonalData () {
    $request = \Slim\Slim::getInstance()->request();
    $person = json_decode($request->getBody());
    
    $sql = "insert into tbl_personaldata (name, surname, birthdate, IM, title, user_id) values
            (:name, :surname, :birthdate, :IM, :title, :user_id)";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("name", $person->name);
        $stmt->bindParam("surname", $person->surname);
        $stmt->bindParam("birthdate", $person->birthdate);
        $stmt->bindParam("IM", $person->IM);
        $stmt->bindParam("title", $person->title);
        $stmt->bindParam("user_id", $person->user_id);
        $stmt->execute();
        $person->id = $db->lastInsertId();
        $db = null;
        //$workingexperience->success = true;
        echo json_encode($person);
    } catch(PDOException $e) {
        logError($e);
        reportError("AddErrorPerson");
    }
}

function addEmails () {
    $request = \Slim\Slim::getInstance()->request();
    $emails = json_decode($request->getBody());
    
    $sql = "insert into tbl_emails (email, primary_mail, user_id) values (:email, :primary_mail, :user_id)";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("email", $emails->email);
        $stmt->bindParam("primary_mail", $emails->primary_mail);
        $stmt->bindParam("user_id", $emails->user_id);
        $stmt->execute();
        $emails->id = $db->lastInsertId();
        $db = null;
        //$emails->success = true;
        echo json_encode($emails);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't add Email");
    }
}


function addAboutMe($user_id) {
    $request = \Slim\Slim::getInstance()->request();
    $about = json_decode($request->getBody());
    
    $sql = "insert into tbl_about (about, photo, user_id) values (:about, :photo, :user_id)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("about", $about->about);
        $stmt->bindParam("photo", $about->photo);
        $stmt->bindParam("user_id", $about->user_id);
        $stmt->execute();
        $about->id = $db->lastInsertId();
        $db = null;
        echo json_encode($about);
    }
    catch (PDOException $e) {
        logError($e);
        reportError('AddAboutException');
    }
}


function uploadFile($user_id) {
    $request = \Slim\Slim::getInstance()->request();
    $uploaddir = './uploads/'.$user_id.'/';
        
    if (!file_exists($uploaddir)) {
        mkdir($uploaddir, 0777, true);
    }
    
    $error = false;
    foreach($_FILES as $file){
        if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name'])))
            $files[] = $uploaddir .$file['name'];
        else
            $error = true;
    }
    $data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
    echo json_encode($data);

}


function addOfficeHours ($user_id) {
    $request = \Slim\Slim::getInstance()->request();
    $office_hours = json_decode($request->getBody());
    
    $sql = "insert into office_hours (office, day, hour_from, hour_to, user_id) values
            (:office, :day, :hour_from, :hour_to, :user_id)";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("office", $office_hours->office);
        $stmt->bindParam("day", $office_hours->day);
        $stmt->bindParam("hour_from", $office_hours->hour_from);
        $stmt->bindParam("hour_to", $office_hours->hour_to);
        $stmt->bindParam("user_id", $office_hours->user_id);
        $stmt->execute();
        $office_hours->id = $db->lastInsertId();
        $db = null;
        //$office_hours->success = true;
        echo json_encode($office_hours);
    } catch(PDOException $e) {
        logError($e);
        reportError("Didn't add Office Hours");
    }
}



function updateNews ($user_id, $id) {
    $request = \Slim\Slim::getInstance()->request();
    $news = json_decode($request->getBody());
    $sql = "update tbl_news set title=:title, date=:date, file=:file, description=:description where user_id=:user_id and id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("title", $news->title);
        $stmt->bindParam("date", $news->date);
        $stmt->bindParam("description", $news->description);
        $stmt->bindParam("file", $news->file);
        $stmt->bindParam("user_id", $news->user_id);
        $stmt->bindParam("id", $news->id);
        $stmt->execute();
        $db = null;
        $news->success = ($stmt->rowCount()  == 1 );
        
        echo json_encode($news);
    }
    catch( PDOException $e) {
        logError($e);
        reportError("Didn't update News");
    }
}

function updateCourses ($user_id, $id) {
    $request = \Slim\Slim::getInstance()->request();
    $courses = json_decode($request->getBody());
    $sql = "update tbl_courses set code=:code, title=:title, review=:review, courses_from=:courses_from, courses_to=:courses_to, courses_current=:courses_current, co_teachers=:co_teachers, school_id=:school_id where user_id=:user_id and id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("code", $courses->code);
        $stmt->bindParam("title", $courses->title);
        $stmt->bindParam("review", $courses->review);
        $stmt->bindParam("courses_from", $courses->courses_from);
        $stmt->bindParam("courses_to", $courses->courses_to);
        $stmt->bindParam("courses_current", $courses->courses_current);
        $stmt->bindParam("co_teachers", $courses->co_teachers);
        $stmt->bindParam("school_id", $courses->school_id);
        $stmt->bindParam("user_id", $courses->user_id);
        $stmt->bindParam("id", $courses->id);
        $stmt->execute();
        $db = null;
        $courses->success = ($stmt->rowCount()  == 1 );
        
        echo json_encode($courses);
    }
    catch( PDOException $e) {
        logError($e);
        reportError("Didn't update Course");
    }
}


function updateEducation ($user_id, $id) {
    $request = \Slim\Slim::getInstance()->request();
    $education = json_decode($request->getBody());
    $sql = "update tbl_education set attended_from=:attended_from, attended_to=:attended_to, current_education=:current_education, fieldOfStudy=:fieldOfStudy, grade=:grade, description=:description, degree_id=:degree_id, school_id=:school_id where user_id=:user_id and id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("attended_from", $education->attended_from);
        $stmt->bindParam("attended_to", $education->attended_to);
        $stmt->bindParam("current_education", $education->current_education);
        $stmt->bindParam("fieldOfStudy", $education->fieldOfStudy);
        $stmt->bindParam("grade", $education->grade);
        $stmt->bindParam("description", $education->description);
        $stmt->bindParam("degree_id", $education->degree_id);
        $stmt->bindParam("school_id", $education->school_id);
        $stmt->bindParam("user_id", $education->user_id);
        $stmt->bindParam("id", $education->id);
        $stmt->execute();
        $db = null;
        $education->success = ($stmt->rowCount()  == 1 );
        
        echo json_encode($education);
    }
    catch( PDOException $e) {
        logError($e);
        reportError("Didn't update Education");
    }
}

function updateCertification ($user_id, $id) {
    $request = \Slim\Slim::getInstance()->request();
    $certifications = json_decode($request->getBody());
    $sql = "update tbl_certifications set name=:name, description=:description, authority=:authority, link=:link, date_from=:date_from, date_to=:date_to, does_not_expire=:does_not_expire, licenseno=:licenseno where user_id=:user_id and id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("name", $certifications->name);
        $stmt->bindParam("description", $certifications->description);
        $stmt->bindParam("authority", $certifications->authority);
        $stmt->bindParam("link", $certifications->link);
        $stmt->bindParam("date_from", $certifications->date_from);
        $stmt->bindParam("date_to", $certifications->date_to);
        $stmt->bindParam("does_not_expire", $certifications->does_not_expire);
        $stmt->bindParam("licenseno", $certifications->licenseno);
        $stmt->bindParam("user_id", $certifications->user_id);
        $stmt->bindParam("id", $certifications->id);
        $stmt->execute();
        $db = null;
        $certifications->success = ($stmt->rowCount()  == 1 );
        echo json_encode($certifications);
    }
    catch( PDOException $e) {
        logError($e);
        reportError("Didn't update Certification");
    }
}

function updatePersonalData ($user_id, $id) {
    $request = \Slim\Slim::getInstance()->request();
    $person = json_decode($request->getBody());
    $sql = "update tbl_personaldata set name=:name, surname=:surname, title=:title, IM=:IM, birthdate=:birthdate, user_id=:user_id where id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("name", $person->name);
        $stmt->bindParam("surname", $person->surname);
        $stmt->bindParam("title", $person->title);
        $stmt->bindParam("IM", $person->IM);
        $stmt->bindParam("birthdate", $person->birthdate);
        $stmt->bindParam("user_id", $person->user_id);
        $stmt->bindParam("id", $person->id);
        $stmt->execute();
        $db = null;
//        $person->success = ($stmt->rowCount()  == 1 );
        
        echo json_encode($person);
    }
    catch( PDOException $e) {
        logError($e);
        reportError("Didn't update Personal Data");
    }
}

function updateOfficeHours ($user_id, $id) {
    $request = \Slim\Slim::getInstance()->request();
    $office_hours = json_decode($request->getBody());
    $sql = "update office_hours set office=:office, day=:day, hour_from=:hour_from, hour_to=:hour_to where user_id=:user_id and id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("office", $office_hours->office);
        $stmt->bindParam("day", $office_hours->day);
        $stmt->bindParam("hour_from", $office_hours->hour_from);        
        $stmt->bindParam("hour_to", $office_hours->hour_to);        
        $stmt->bindParam("user_id", $office_hours->user_id);
        $stmt->bindParam("id", $office_hours->id);
        $stmt->execute();
        $db = null;
        $office_hours->success = ($stmt->rowCount()  == 1 );
        
        echo json_encode($office_hours);
    }
    catch( PDOException $e) {
        logError($e);
        reportError("Didn't update Office Hours");
    }
}


function updateAbout ($user_id, $id) {
    $request = \Slim\Slim::getInstance()->request();
    $about = json_decode($request->getBody());
    $sql = "update tbl_about set about=:about, photo=:photo where user_id=:user_id and id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("about", $about->about);
        $stmt->bindParam("photo", $about->photo);
        $stmt->bindParam("user_id", $about->user_id);
        $stmt->bindParam("id", $about->id);
        $stmt->execute();
        $db = null;
        $about->success  = ($stmt->rowCount()  == 1 );
        echo json_encode($about);
    }
    catch (PDOException $e) {
        logError($e);
        reportError('AboutUpdateException');
    }
}

function updateEmail ($user_id, $id) {
    $request = \Slim\Slim::getInstance()->request();
    $emails = json_decode($request->getBody());
    $sql = "update tbl_emails set email=:email, primary_mail=:primary_mail, user_id=:user_id where id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("email", $emails->email);
        $stmt->bindParam("primary_mail", $emails->primary_mail);
        $stmt->bindParam("user_id", $emails->user_id);
        $stmt->bindParam("id", $emails->id);
        $stmt->execute();
        $db = null;
      $emails->success = ($stmt->rowCount()  == 1 );
        
        echo json_encode($emails);
    }
    catch( PDOException $e) {
        logError($e);
        reportError("Didn't update Email");
    }
}

function updateCompany ($user_id, $id) {
    $request = \Slim\Slim::getInstance()->request();
    $companies = json_decode($request->getBody());
    $sql = "update tbl_company set name=:name, address=:address, phone=:phone, link=:link where user_id=:user_id and id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("name", $companies->name);
        $stmt->bindParam("address", $companies->address);
        $stmt->bindParam("phone", $companies->phone);
        $stmt->bindParam("link", $companies->link);
        $stmt->bindParam("user_id", $companies->user_id);
        $stmt->bindParam("id", $companies->id);
        $stmt->execute();
        $db = null;
        $companies->success = ($stmt->rowCount()  == 1 );

        echo json_encode($companies);
    }
    catch( PDOException $e) {
        logError($e);
        reportError("Didn't update Company");
    }
}

function updateHonors ($user_id, $id) {
    $request = \Slim\Slim::getInstance()->request();
    $honors = json_decode($request->getBody());
    $sql = "update tbl_honors_awards set date=:date, description=:description, issuer=:issuer, title=:title where user_id=:user_id and id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("date", $honors->date);
        $stmt->bindParam("description", $honors->description);
        $stmt->bindParam("issuer", $honors->issuer);
        $stmt->bindParam("title", $honors->title);
        $stmt->bindParam("user_id", $honors->user_id);
        $stmt->bindParam("id", $honors->id);
        $stmt->execute();
        $db = null;
        $honors->success = ($stmt->rowCount()  == 1 );
        
        echo json_encode($honors);
    }
    catch( PDOException $e) {
        logError($e);
        reportError("Didn't update Honor- Award");
    }
}

function updateInterest ($user_id, $id) {
    $request = \Slim\Slim::getInstance()->request();
    $interests = json_decode($request->getBody());
    $sql = "update tbl_interests set description=:description where user_id=:user_id and id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("description", $interests->description);
        $stmt->bindParam("user_id", $interests->user_id);
        $stmt->bindParam("id", $interests->id);
        $stmt->execute();
        $db = null;
        $interests->success = ($stmt->rowCount()  == 1 );
        
        echo json_encode($interests);
    }
    catch( PDOException $e) {
        logError($e);
        reportError("Didn't update Interest");
    }
}

function updateLanguage ($user_id, $id) {
    $request = \Slim\Slim::getInstance()->request();
    $languages = json_decode($request->getBody());
    $sql = "update tbl_languages set name=:name, level_id=:level_id where user_id=:user_id and id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("name", $languages->name);
        $stmt->bindParam("level_id", $languages->level_id);
        $stmt->bindParam("user_id", $languages->user_id);
        $stmt->bindParam("id", $languages->id);
        $stmt->execute();
        $db = null;
        $languages->success = ($stmt->rowCount()  == 1 );
        
        echo json_encode($languages);
    }
    catch( PDOException $e) {
        logError($e);
        reportError("Didn't update Language");
    }
}

function updateOrganization ($user_id, $id) {
    $request = \Slim\Slim::getInstance()->request();
    $organizations = json_decode($request->getBody());
    $sql = "update tbl_organizations set name=:name, position=:position, date_from=:date_from, date_to=:date_to, current_position=:current_position, description=:description where user_id=:user_id and id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("name", $organizations->name);
        $stmt->bindParam("position", $organizations->position);
        $stmt->bindParam("date_from", $organizations->date_from);
        $stmt->bindParam("date_to", $organizations->date_to);
        $stmt->bindParam("current_position", $organizations->current_position);
        $stmt->bindParam("description", $organizations->description);
        $stmt->bindParam("user_id", $organizations->user_id);
        $stmt->bindParam("id", $organizations->id);
        $stmt->execute();
        $db = null;
        $organizations->success = ($stmt->rowCount()  == 1 );
        
        echo json_encode($organizations);
    }
    catch( PDOException $e) {
        logError($e);
        reportError("Didn't update Organization");
    }
}

function updatePhone ($user_id, $id) {
    $request = \Slim\Slim::getInstance()->request();
    $phones = json_decode($request->getBody());
    $sql = "update tbl_phones set phone=:phone,type=:type where user_id=:user_id and id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("phone", $phones->phone);
        $stmt->bindParam("type", $phones->type); 
        $stmt->bindParam("user_id", $phones->user_id);
        $stmt->bindParam("id", $phones->id);
        $stmt->execute();
        $db = null;
        $phones->success = ($stmt->rowCount()  == 1 );
        
        echo json_encode($phones);
    }
    catch( PDOException $e) {
        logError($e);
        reportError("Didn't update Phone");
    }
}

function updateAddress ($user_id, $id) {
    $request = \Slim\Slim::getInstance()->request();
    $addresses = json_decode($request->getBody());
    $sql = "update tbl_addresses set street=:street, primary_address=:primary_address, no=:no, city=:city, postal_code=:postal_code where user_id=:user_id and id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("street", $addresses->street);
        $stmt->bindParam("primary_address", $addresses->primary_address);
        $stmt->bindParam("no", $addresses->no);        
        $stmt->bindParam("city", $addresses->city);        
        $stmt->bindParam("postal_code", $addresses->postal_code);    
        $stmt->bindParam("user_id", $addresses->user_id);
        $stmt->bindParam("id", $addresses->id);
        $stmt->execute();
        $db = null;
        $addresses->success = ($stmt->rowCount()  == 1 );
        
        echo json_encode($addresses);
    }
    catch( PDOException $e) {
        logError($e);
        reportError("Didn't update Address");
    }
}

function updateProject ($user_id, $id) {
    $request = \Slim\Slim::getInstance()->request();
    $projects = json_decode($request->getBody());
    $sql = "update tbl_projects_research set name=:name, description=:description, date_from=:date_from, date_to=:date_to, current_project=:current_project, team_members=:team_members, link=:link, company_id=:company_id, education_id=:education_id where user_id=:user_id and id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("name", $projects->name);
        $stmt->bindParam("description", $projects->description);
        $stmt->bindParam("date_from", $projects->date_from);        
        $stmt->bindParam("date_to", $projects->date_to);        
        $stmt->bindParam("current_project", $projects->current_project);      
        $stmt->bindParam("team_members", $projects->team_members);      
        $stmt->bindParam("link", $projects->link);      
        $stmt->bindParam("company_id", $projects->company_id);      
        $stmt->bindParam("education_id", $projects->education_id);      
        $stmt->bindParam("user_id", $projects->user_id);
        $stmt->bindParam("id", $projects->id);
        $stmt->execute();
        $db = null;
        $projects->success = ($stmt->rowCount()  == 1 );
        
        echo json_encode($projects);
    }
    catch( PDOException $e) {
        logError($e);
        reportError("Didn't update Project- Research");
    }
}

function updatePublication ($user_id, $id) {
    $request = \Slim\Slim::getInstance()->request();
    $publications = json_decode($request->getBody());
    $sql = "update tbl_publications set title=:title, date=:date, link=:link, publisher=:publisher, authors=:authors, description=:description where user_id=:user_id and id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("title", $publications->title);
        $stmt->bindParam("date", $publications->date);
        $stmt->bindParam("link", $publications->link);        
        $stmt->bindParam("publisher", $publications->publisher);        
        $stmt->bindParam("authors", $publications->authors);      
        $stmt->bindParam("description", $publications->description);
        $stmt->bindParam("user_id", $publications->user_id);
        $stmt->bindParam("id", $publications->id);
        $stmt->execute();
        $db = null;
        $publications->success = ($stmt->rowCount()  == 1 );
        
        echo json_encode($publications);
    }
    catch( PDOException $e) {
        logError($e);
        reportError("Didn't update Publication");
    }
}

function updateSchool ($user_id, $id) {
    $request = \Slim\Slim::getInstance()->request();
    $schools = json_decode($request->getBody());
    $sql = "update tbl_school set name=:name, address=:address, phone=:phone, link=:link where user_id=:user_id and id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("name", $schools->name);
        $stmt->bindParam("address", $schools->address);
        $stmt->bindParam("phone", $schools->phone);        
        $stmt->bindParam("link", $schools->link);        
        $stmt->bindParam("user_id", $schools->user_id);
        $stmt->bindParam("id", $schools->id);
        $stmt->execute();
        $db = null;
        $schools->success = ($stmt->rowCount()  == 1 );
        
        echo json_encode($schools);
    }
    catch( PDOException $e) {
        logError($e);
        reportError("Didn't update School");
    }
}

function updateWorkingExperience ($user_id, $id) {
    $request = \Slim\Slim::getInstance()->request();
    $workingexperience = json_decode($request->getBody());
    $sql = "update tbl_workingexperience set title=:title, timeperiod_from=:timeperiod_from, timeperiod_to=:timeperiod_to, current_job=:current_job, description=:description, company_id=:company_id where user_id=:user_id and id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("title", $workingexperience->title);
        $stmt->bindParam("timeperiod_from", $workingexperience->timeperiod_from);
        $stmt->bindParam("timeperiod_to", $workingexperience->timeperiod_to);        
        $stmt->bindParam("current_job", $workingexperience->current_job);
        $stmt->bindParam("description", $workingexperience->description);
        $stmt->bindParam("company_id", $workingexperience->company_id);
        $stmt->bindParam("user_id", $workingexperience->user_id);
        $stmt->bindParam("id", $workingexperience->id);
        $stmt->execute();
        $db = null;
        $workingexperience->success = ($stmt->rowCount()  == 1 );
        
        echo json_encode($workingexperience);
    }
    catch( PDOException $e) {
        logError($e);
        reportError("Didn't update Working Experience");
    }
}




function deleteNews ($user_id, $newsId) {
    $request = \Slim\Slim::getInstance()->request();
    $news = json_decode($request->getBody());
    
    $sql = "delete from tbl_news where id=:id";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $newsId);
        $stmt->execute();
        $db = null;
        
//        $news->success = true;//($stmt->rowCount() == 1);
        
        echo json_encode($news);
    }
    catch (PDOException $e) {
        logError($e);
        reportError("deleteNews");
    }
}

function deleteCourses ($user_id,$id) {
    $request = \Slim\Slim::getInstance()->request();
    $courses = json_decode($request->getBody());
    
    $sql = "delete from tbl_courses where user_id=:user_id and id=:id";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($courses);
    }
    catch (PDOException $e) {
        logError($e);
        reportError("Didn't delete Course");
    }
}

function deleteEducation ($user_id,$id) {
    $request = \Slim\Slim::getInstance()->request();
    $education = json_decode($request->getBody());
    
    $sql = "delete from tbl_education where user_id=:user_id and id=:id";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($education);
    }
    catch (PDOException $e) {
        logError($e);
        reportError("Didn't delete Education");
    }
}

function deleteCertification ($user_id,$id) {
    $request = \Slim\Slim::getInstance()->request();
    $certifications = json_decode($request->getBody());
    
    $sql = "delete from tbl_certifications where user_id=:user_id and id=:id";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($certifications);
    }
    catch (PDOException $e) {
        logError($e);
        reportError("Didn't delete Certification");
    }
}

function deleteCompany ($user_id,$id) {
    $request = \Slim\Slim::getInstance()->request();
    $companies = json_decode($request->getBody());
    
    $sql = "delete from tbl_company where user_id=:user_id and id=:id";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($companies);
    }
    catch (PDOException $e) {
        logError($e);
        reportError("Didn't delete Company");
    }
}

function deleteHonors ($user_id,$id) {
    $request = \Slim\Slim::getInstance()->request();
    $honors = json_decode($request->getBody());
    
    $sql = "delete from tbl_honors_awards where user_id=:user_id and id=:id";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($honors);
    }
    catch (PDOException $e) {
        logError($e);
    reportError("Didn't delete Honor- Award");
    }
}

function deleteInterest ($user_id,$id) {
    $request = \Slim\Slim::getInstance()->request();
    $interests = json_decode($request->getBody());
    
    $sql = "delete from tbl_interests where user_id=:user_id and id=:id";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($interests);
    }
    catch (PDOException $e) {
        logError($e);
    reportError("Didn't delete Interest");
    }
}

function deleteLanguage ($user_id,$id) {
    $request = \Slim\Slim::getInstance()->request();
    $languages = json_decode($request->getBody());
    
    $sql = "delete from tbl_languages where user_id=:user_id and id=:id";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($languages);
    }
    catch (PDOException $e) {
        logError($e);
    reportError("Didn't delete Language");
    }
}

function deleteOrganization ($user_id,$id) {
    $request = \Slim\Slim::getInstance()->request();
    $organizations = json_decode($request->getBody());
    
    $sql = "delete from tbl_organizations where user_id=:user_id and id=:id";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($organizations);
    }
    catch (PDOException $e) {
        logError($e);
    reportError("Didn't delete Organization");
    }
}

function deletePhone ($user_id,$id) {
    $request = \Slim\Slim::getInstance()->request();
    $phones = json_decode($request->getBody());
    
    $sql = "delete from tbl_phones where user_id=:user_id and id=:id";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($phones);
    }
    catch (PDOException $e) {
        logError($e);
    reportError("Didn't delete Phone");
    }
}

function deleteAddress ($user_id,$id) {
    $request = \Slim\Slim::getInstance()->request();
    $addresses = json_decode($request->getBody());
    
    $sql = "delete from tbl_addresses where user_id=:user_id and id=:id";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($addresses);
    }
    catch (PDOException $e) {
        logError($e);
    reportError("Didn't delete Address");
    }
}

function deleteProject ($user_id,$id) {
    $request = \Slim\Slim::getInstance()->request();
    $projects = json_decode($request->getBody());
    
    $sql = "delete from tbl_projects_research where user_id=:user_id and id=:id";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($projects);
    }
    catch (PDOException $e) {
        logError($e);
    reportError("Didn't delete Project");
    }
}

function deletePublication ($user_id,$id) {
    $request = \Slim\Slim::getInstance()->request();
    $publications = json_decode($request->getBody());
    
    $sql = "delete from tbl_publications where user_id=:user_id and id=:id";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($publications);
    }
    catch (PDOException $e) {
        logError($e);
    reportError("Didn't delete Publication");
    }
}

function deleteSchool ($user_id,$id) {
    $request = \Slim\Slim::getInstance()->request();
    $schools = json_decode($request->getBody());
    
    $sql = "delete from tbl_school where user_id=:user_id and id=:id";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($schools);
    }
    catch (PDOException $e) {
        logError($e);
    reportError("Didn't delete School");
    }
}

function deleteWorkingExperience ($user_id,$id) {
    $request = \Slim\Slim::getInstance()->request();
    $workingexperience = json_decode($request->getBody());
    
    $sql = "delete from tbl_workingexperience where user_id=:user_id and id=:id";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($workingexperience);
    }
    catch (PDOException $e) {
        logError($e);
    reportError("Didn't delete Working Experience");
    }
}

function deletePersonalData ($user_id,$id) {
    $request = \Slim\Slim::getInstance()->request();
    $personalData = json_decode($request->getBody());
    
    $sql = "delete from tbl_personaldata where user_id=:user_id and id=:id";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($personalData);
    }
    catch (PDOException $e) {
        logError($e);
    reportError("Didn't delete Personal Data");
    }
}

function deleteEmail ($user_id,$id) {
    $request = \Slim\Slim::getInstance()->request();
    $emails = json_decode($request->getBody());
    
    $sql = "delete from tbl_emails where user_id=:user_id and id=:id";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($emails);
    }
    catch (PDOException $e) {
        logError($e);
    reportError("Didn't delete Email");
    }
}

function deleteOfficeHours ($user_id,$id) {
    $request = \Slim\Slim::getInstance()->request();
    $office_hours = json_decode($request->getBody());
    
    $sql = "delete from office_hours where user_id=:user_id and id=:id";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($office_hours);
    }
    catch (PDOException $e) {
        logError($e);
    reportError("Didn't delete Office Hours");
    }
}

##################################################################################
/*
 *  
 * Application specific methods
 * Add custom logic
 * ( To get the request use: \Slim\Slim::getInstance() -> request();)
 */

function login() {
    $request = \Slim\Slim::getInstance() -> request();
    
     $result = new stdClass();
    
    $typed_email = $request->post('un');
	$typed_pass = $request->post('pw');
    
    
    $sql = "select id, username, password  from tbl_user where username=:username limit 1";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("username", $typed_email);
        $stmt->execute();
        
        $user = $stmt->fetchObject();//fetchAll(PDO::FETCH_OBJ);
        
//        var_dump($user);
        
        if ( $user ) {
             // If the user exists we check if the account is locked
		    // from too many login attempts 
             if (checkbrute($user->id, $db) == true) {
		        // Account is locked 
		        // Send an email to user saying their account is locked
                 reportError("lockedAccnt");
             }
            else {
                // Check if the password in the database matches
		        // the password the user submitted.
                 $typed_pass = hash('sha512', $typed_pass);
                
                if (strtolower($user->password) == strtolower($typed_pass)) {
                    $sql = "select u.`id`, d.`name`, d.`surname`, d.`birthdate`, d.`IM`, d.`title`, e.`email` 
                                                    from tbl_personaldata as d 
                                                    left join tbl_emails as e on d.`user_id` = e.`user_id` and e.`primary_mail` = 1 
                                                    inner join tbl_user as u on d.`user_id` = u.`id` where u.`id` = :id";
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam("id", $user->id);
                    $stmt->execute();
                    
                    $result = $stmt->fetchObject();
                    
                    $result->success = true;
                    
                    echo json_encode($result);
                }
                else {
                    // Password is not correct
                    // We record this attempt in the database
                    $now = time();
//                    $mysqli->query("INSERT INTO login_attempts(user_id, time)
//		                            VALUES ('$id', '$now')");
                     $sql = "INSERT INTO login_attempts(user_id, time) VALUES (:user_id, :now)";
                    
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam("user_id", $user->id);
                    $stmt->bindParam("now", $now);
                    $stmt->execute();
                    
                    reportError("login-failed");
                }
            }
            
        }
        else{  // User does not exist
            reportError("login-failed");
        }
        
    } catch(PDOException $e) {
        logError($e);
    }
}



	/**
	 *  Brute Force avoidance function
	 *	we'll log failed attempts and lock the user's account after five failed login attempts. This should trigger the sending of an email to the user with *	a reset link, but we have not implemented this in our code.
	 */
function checkbrute($user_id, $db) {
  // return false;
    // Get timestamp of current time
    $now = time();
    
    // All login attempts are counted from the past 2 hours. 
    $valid_attempts = $now - (2 * 60 * 60);
    
    try{
        $sql = "SELECT time FROM login_attempts WHERE user_id = :user_id AND time > :valid_attempts";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->bindParam("valid_attempts", $valid_attempts);
        $stmt->execute();
        $attempts = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        return (count($attempts) > 5);
    } catch(PDOException $e) {
        logError($e);
        reportError($e->getMessage());
    }
}

