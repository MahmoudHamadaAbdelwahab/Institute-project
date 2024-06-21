<?php
    session_start();
    define("BURL","http://localhost/MedicalClinic/");
    define("BURLA","http://localhost/MedicalClinic/admin/");
    define("ASSETS","http://localhost/MedicalClinic/assets/");
    define("BURL_AUTH","http://localhost/MedicalClinic/authentication/");
    define("BURL_DOC","http://localhost/MedicalClinic/doctor/");
    define("BURL_PATIENT","http://localhost/MedicalClinic/patient/");
    define("BURL_PAGE","http://localhost/MedicalClinic/page/");
    define("BL",__DIR__.'/'); // __DIR__ It comes with a project path
    define("BLA",__DIR__.'/admin/');
    // connect to database
    require_once(BL.'functions/db.php');
?>