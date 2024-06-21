    <!-- insert data when user booking -->
    <?php
        if(isset($_POST['booking'])){
            $resPrice = $_POST['docSallary'];
            $resPatientId = $_SESSION['PatientId'];
            $resPatientEmail = $_SESSION['patient_email'];
            $resDoctorDate = $_POST['docDate'];
            $resDoctorId = $_POST['docId'];
           
            $sql = "INSERT INTO reservation (reservation_patient_email) VALUES ('$resPatientEmail')";
            echo $success_message = db_insert($sql);
           
            // show message
            require BL.'functions/messages.php';
        }
    ?>

    <!-- login page -->

    
<?php
    require_once('../../config.php');
    require_once BL.'functions/db.php';
    require_once BL.'functions/messages.php';
    require_once BL.'functions/valid.php';
    require_once BLA.'inc/nav.php';

    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);// removes backslashes
        $username = mysqli_real_escape_string($conn, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        
        // Check user is exist in the database
        $query = "SELECT * FROM patient WHERE patient_name = '$username' AND patient_password = '$password'";
        $query2 = "SELECT * FROM doctor WHERE doctorName = '$username' AND doctorPassword = '$password'";
        
        if($query){
            $result = mysqli_query($conn, $query);
        }else{
            $result = mysqli_query($conn, $query2);
        }
        
        // $result = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
                $user = mysqli_fetch_assoc($result);

                if( ($user['patient_role'] == 'patient' 
                || $user['patient_role'] == '')){
                // Login successful, set session variables
                $_SESSION['PatientId'] = $user['PatientId'];
                $_SESSION['patient_name'] = $user['patient_name'];
                $_SESSION['patient_role'] = $user['patient_role'];
                }else{
                    // Login successful, set session variables
                    $_SESSION['doctorId'] = $user['doctorId'];
                    $_SESSION['doctorName'] = $user['doctorName'];
                    $_SESSION['doctorRole'] = $user['doctorRole'];
                }

                $delay = 2;  // Delay in seconds before refreshing the page
                header("Refresh: $delay"); // Redirect to the current page after the specified delay
                echo $success_message = "<h3>successfully login</h3>";
                echo "<div class='form_success'>
                         <h3> successfully login </h3><br/>
                     </div>";
                header('location:../../page/homePage.php');
        } else {
            echo $error_message = "<h3>Incorrect Username or password.</h3>";
            echo "<div class='form_error'>
                    <h3>Incorrect Username or password.</h3><br/>
                 </div>";
            header('location:login.php');
            }
    }else{
?>
<!-- HTML Form code here -->
<?php } ?>



<!-- our doctor -->
<?php
    require_once('../config.php');
    require_once BLA.'inc/nav.php';
    require_once BL.'functions/valid.php';
    require_once BL.'functions/db.php';
    // sent data to table reservation in database
    if(isset($_POST['Booking'])){
        echo $name  =  $_POST['name'];
        echo $specialty  =  $_POST['specialty'];
        echo $phone  =  $_POST['phone'];
        echo $date  =   $_POST['date'];
        echo $price  =  $_POST['price'];
        echo $id_doctor  =  $_POST['id_doctor'];
        echo $id_Patient  = $_POST['id_Patient'];
        echo $email_Patient  = $_POST['email_Patient'];

        $query = "INSERT INTO  reservation (reservation_price ,reservation_patient_id , reservation_patient_email , reservation_doctor_date , reservation_doctor_id  ) VALUE ('$price' , '$id_Patient' , '$email_Patient' ,'$date' ,'$id_doctor' )";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "<div class='form_success container'>
                      <h3>successfully booking a doctor</h3><br/>
                  </div>";
        } else {
            echo "<div class='form_error'>
                      <h3>not booking a doctor</h3><br/>
                  </div>";
        }
  }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin/assets/css/ourDoctors.css">
    <style>
        .patientEmail{
            display: none;
        }
    </style>
</head>
<body>
    
<div class="OurDoctors mb-3">
        <div class='textOurDoc'>
            <h4 class="text-center">Our Doctors</h4>
        </div>
        <div class="container mt-5 mb-5">
                <div class='CartText mt-2 mb-2'>
                    <h3 class='mt-2'>Best doctors from Dcotors Medical Center</h3>
                    <p>Doctors Medical Center is overseen by a team of highly experienced healthcare experts from the Amina Healthcare Group. These professionals have meticulously selected each hospital and clinic in their portfolio based on rigorous quality benchmarks. Our commitment to clinical excellence and the delivery of ethical, high-quality healthcare is underscored by our adherence to stringent quality assurance standards. Regardless of whether you’re an outpatient or a day case patient, you can have complete confidence in the care provided by our skilled clinical team. They are devoted to ensuring that you receive optimal treatment and achieve a swift recovery.</p>
                </div>
                <div class='d-flex justify-content-center gap-5'>
                        <!-- get data from backend api --> 
                    <div class='SpecialDoc col-sm-12 col-md-12 col-lg-12'>
                        <div class='text-SpecialDoc'>
                            <h3>Our new doctors</h3>
                        </div>
                        <!-- show all doctors -->
                        <div class="allDoctors m-2">
                            <form action="" method="POST">
                                <?php
                                    // when login the patient , how the delete error when login the doctor because the session id result id doctor not patient
                                    if(isset($_SESSION['PatientId']) && isset($_SESSION['patient_email']) ){
                                        $patientId = $_SESSION['PatientId'];
                                        $patientEmail = $_SESSION['patient_email'];
                                    }
                                    else{
                                        $patientId = 0;
                                        $patientEmail = "";
                                    }
                                    // show all doctor
                                    $query = "SELECT * FROM doctor";
                                    $result = mysqli_query($conn , $query);
                                    
                                    while($row = mysqli_fetch_array($result)){
                                        echo "
                                            <div class='card' style='width: 18rem;'>
                                                <img src='../admin/dashboard/$row[doctorImage]' class='card-img-top'>
                                                <div class='card-body'>
                                                    <h5 class='card-title' name='name'>$row[doctorName]</h5>
                                                    <p class='card-text' name='specialty' >$row[doctorIsSpecialty]</p>
                                                    <p class='card-text' name='phone' >$row[doctorPhone]</p>
                                                    <p class='card-text' name='date' >$row[doctorDate]</p>
                                                    <p class='card-text' name='price' >$row[doctor_booking_price]</p>
                                                    <input class='patientEmail' type='text' name='email_Patient' value=$patientEmail/>
                                                    <input type='text' name='id_doctor' value=$row[doctorId] style='display:none;'/>
                                                    <input type='text' name='id_Patient' value=$patientId style='display:none;' />
                                                    <a href='#' name='Booking' class='btn btn-primary'>Booking Now</a>
                                                </div>
                                            </div>
                                        ";
                                    }
                                ?>
                            </form>
                         </div>
                         <!-- <a href='reservConfirmation.php? id=$row[doctorId]' name='Booking' class='btn btn-primary'>Booking Now</a>  -->
                         <!-- <a href='../patient/personalPatient.php? id_doctor=$row[doctorId]' name='Booking' class='btn btn-primary'>Booking Now</a> -->
                         <!-- reservation confirmation  -->
                    </div>
                </div>
        </div>
</div>

</body>
</html>
<?php require_once BLA.'inc/footer.php';?>

    <!-- start Customer opinion -->

    <!-- <h1>Customer opinion</h1>  
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
    <div class="carousel">
    <?php
                // require_once BL.'functions/db.php';
                // require_once BL.'functions/messages.php';
                // require_once BL.'functions/valid.php';
                // $query = "SELECT * FROM opinion";
                // $result = mysqli_query($conn , $query);
                // while($row = mysqli_fetch_array($result)){
                //     echo "
                //     <div class='carousel-item active'>
                //         <div class='card' style='width: 18rem;'>
                //             <div class='d-flex justify-content-around'>
                //                 <p class='card-title'> $row[name]</p>    
                //                 <p class='card-title'> $row[address]</p>  
                //             </div>
                //             <div class='card-body'>
                //                 <p class='card-text'>$row[message]</p>
                //             </div>
                //         </div>
                //     </div>
                //     ";
                // }
            ?>
            
    </div> -->
    
    <!--  end Customer opinion   -->

    <!-- start home page  -->
<?php 
require_once('../config.php');
require_once BLA.'inc/nav.php';
require_once BL.'functions/valid.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../admin/assets/css/homePage.css">
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta3/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .container{
                text-align: center;
            }
            /* start slider */
            .slider_Home{
                background-image: url('../imag/gallery/hero-bg.png');
                background-size: cover;
                height: 100%;
                text-align: center;
            }

             .slider_Home .slider-title{
                color: #0d6efd;
                font-weight: bold;
                font-size: 30px;
            };
            .slider_Home .slider-text{
                font-size: 16px;
            }
            .slider_Home .cart .click a{
                text-decoration: none;
                font-size: 20px;
                font-weight:bold; 
                color: black
            };
            /* end slider */

            /* start department */
             .department{
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 15px;
            }
            /* end department */

            /* start all doctor */
            .allDoctors{
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            }
            .allDoctors .card img{
            width: 100%;
            height: 200px;
            padding: 10px;
            }
            .name_depart{
                text-decoration: none;
            }
            /* end all doctor */

            /* start Customer opinion  */
            .star {
            font-size: 2em;
            cursor: pointer;
            color: gray;
            }
            .star.selected {
                color: gold;
            }
            .slider_opinion{
                width: 80%;
                margin: 20px auto;
            }
            .slide {
                padding: 20px;
                text-align: center;
            }
            .stars {
                font-size: 1.5em;
            }
            /* end Customer opinion  */
        </style>
    </head>
    <body>
        <div class="slider_Home text-center">
            <div class="container">
                <div class="row d-flex justify-content-center align-items-center text-center">
                    <div class="col-sm-5 col-lg-6">
                        <img
                        class="img_doc pt-7 pt-md-0 img-fluid"
                        src="../imag/gallery/teamDoc3.png"
                        alt="First slide"
                        />
                    </div>
                    <div class="cart col-sm-7 col-lg-6">
                        <h3 class="slider-title">We're determined for your better life.</h3>
                        <p class="slider-text">There is a huge discount of up to 50% off bookings</p>
                        <button class="click">
                            <a href="../admin/admins/contactUs.php">Get in Touch</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
                <!-- start department page -->
                    <h1>Department</h1>
                    <div class="allDoctors">
                        <?php
                            require_once BL.'functions/db.php';
                            require_once BL.'functions/messages.php';
                            require_once BL.'functions/valid.php';
                            $query = "SELECT * FROM department";
                            $result = mysqli_query($conn , $query);
                            while($row = mysqli_fetch_array($result)){
                                echo "<div class='justify-content-center col-sm-2 col-md-2 col-lg-2'>
                                    <a class='name_depart' href='doctors.php?department_id=$row[depart_id]'>
                                        <img src='../admin/dashboard/$row[depart_image]' style='width:70px'/>
                                        <h5>$row[depart_name]</h5>
                                    </a>
                                </div>";
                            }
                        ?>
                    </div>
                <!-- end department page -->

                <!-- start show all doctor -->
                <div>
                    <!-- Doctors page -->
                    <h1>Doctors</h1>
                    <div class="allDoctors text-center">
                        <?php
                            require_once BL.'functions/db.php';
                            require_once BL.'functions/messages.php';
                            require_once BL.'functions/valid.php';
                            $query = "SELECT * FROM doctor";
                            $result = mysqli_query($conn , $query);
                            while($row = mysqli_fetch_array($result)){
                                // show the department name
                                $depart_Id = $row['depart_id'];
                                $query_depart = "SELECT * FROM department WHERE depart_id = '$depart_Id'";
                                $result_depart = mysqli_query($conn , $query_depart);
                                $row_depart = mysqli_fetch_array($result_depart);

                                echo "
                                <div>
                                    <div class='card' style='width: 18rem;'>
                                        <img src='../admin/dashboard/$row[doctorImage]' class='card-img-top'>
                                        <div class='card-body'>
                                            <h5 class='card-title'>$row[doctorName]</h5>
                                            <p class='card-text'>$row_depart[depart_name]</p>
                                            <p class='card-text'>$row[doctorPhone]</p>
                                            <p class='card-text'>$row[doctorDate]</p>
                                            <p class='card-text'>$row[doctor_booking_price]</p>
                                        </div>
                                    </div>
                                </div>
                                ";
                            }
                        ?>
                        </div>
                </div>
                <!-- end show all doctor -->

                <!-- start last post -->
                <div>
                    <!-- last post -->
                    <h1>last post</h1>
                    <div class="allDoctors">
                        <?php
                            require_once BL.'functions/db.php';
                            require_once BL.'functions/messages.php';
                            require_once BL.'functions/valid.php';
                            $query = "SELECT * FROM lastpost";
                            $result = mysqli_query($conn , $query);
                            while($row = mysqli_fetch_array($result)){
                                $image_path = $row['lastPost_Image'];
                                $About = mb_strimwidth($row['lastPost_About'], 0, 25 , "...");
                                $writeHere = mb_strimwidth($row['lastPost_writeHere'], 0, 70, "...");
                                
                                // Call the doctor to have his name appear
                                $doctor_id = $row['doctor_Id'];
                                $query_doc = "SELECT * FROM doctor WHERE doctorId = '$doctor_id'";
                                $result_doc = mysqli_query($conn,$query_doc);
                                $row_doc = mysqli_fetch_array($result_doc);

                                // Show the department of the doctor
                                $depart_id = $row_doc['depart_id'];
                                $query_depart = "SELECT * FROM department WHERE depart_id = '$depart_id'";
                                $result_depart = mysqli_query($conn,$query_depart);
                                $row_depart = mysqli_fetch_array($result_depart);
                                
                                echo "
                                <div>
                                    <div class='card' style='width: 18rem;'>
                                        <img src='../doctor/$image_path' class='card-img-top'>
                                        <div class='d-flex justify-content-around'>
                                            <p class='card-title'> $row_doc[doctorName]</p>    
                                            <p class='card-title'> $row_depart[depart_name]</p>  
                                        </div>
                                        <div class='card-body'>
                                            <h5 class='card-title'>$About</h5>
                                            <p class='card-text'>$writeHere</p>
                                        </div>
                                    </div>
                                </div>
                                ";
                            }
                        ?>
                        </div>
                </div>
                <!-- ent last post -->

                <!-- start Customer opinion -->
                <h1>Customer Opinion</h1>
                <div class="slider" id="opinions-slider">
                    <!-- Slides will be appended here by JavaScript -->
                </div>
                <!--  end Customer opinion   -->

                <!-- start map  -->
                <h1>The location</h1>  
                <p><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13813.242694188517!2d31.340407351171343!3d30.05662807107523!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14583e5d94c66301%3A0xddddf100de42206c!2z2YXYr9mK2YbZhyDZhti12LHYjCDYp9mE2YXZhti32YLYqSDYp9mE2KPZiNmE2YnYjCDZhdiv2YrZhtipINmG2LXYsdiMINmF2K3Yp9mB2LjYqSDYp9mE2YLYp9mH2LHYqeKArCA0NDUwMTEz!5e0!3m2!1sar!2seg!4v1717591853676!5m2!1sar!2seg" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></p>
                <!-- end map  -->
        </div>

        <!-- start Customer opinion -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                const stars = document.querySelectorAll('.star');
                const ratingInput = document.getElementById('rating-input');
                stars.forEach(star => {
                    star.addEventListener('click', rateStar);
                });

                function rateStar(event) {
                    const selectedStar = event.target;
                    const rating = selectedStar.getAttribute('data-value');
                    
                    stars.forEach(star => {
                        star.classList.remove('selected');
                    });

                    for (let i = 0; i < rating; i++) {
                        stars[i].classList.add('selected');
                    }

                    ratingInput.value = rating;
                }

                // Fetch and display opinions
                fetch('get_opinions.php')
                    .then(response => response.json())
                    .then(data => {
                        const slider = $('#opinions-slider');
                        data.forEach(opinion => {
                            const stars = '★'.repeat(opinion.rating) + '☆'.repeat(5 - opinion.rating);
                            slider.append(`
                                <div class="slide">
                                    <h3>${opinion.name}</h3>
                                    <p>${opinion.phone}</p>
                                    <p>${opinion.address}</p>
                                    <p>${opinion.message}</p>
                                    <div class="stars">${stars}</div>
                                </div>
                            `);
                        });

                        // Initialize Slick Slider
                        slider.slick({
                            dots: true,
                            infinite: true,
                            speed: 300,
                            slidesToShow: 1,
                            adaptiveHeight: true
                        });
                    });
            });
        </script>
        <!--  end Customer opinion   -->
    </body>
</html>
<!-- footer -->
<?php require_once BLA.'inc/footer.php';?>

<!-- end home page -->

<!-- start personal patient  -->
<?php
    require_once('../config.php');
    require_once BLA.'inc/nav.php';
    require_once BL.'functions/valid.php';
    require_once BL.'functions/db.php';

    $patient = isset($_SESSION['patient_name']) && ($_SESSION['patient_role'] == 'patient'
    || $_SESSION['patient_role'] == '') ? $_SESSION['patient_name'] : null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <!-- while loop -->
    <div class="container text-center">
        <div class="col-sm-12">
            <?php if(isset($_SESSION['patient_name'])): ?>
                 <h3 class="p-3 bg-primary text-white">
                    Welcome <?php echo $_SESSION['patient_name']; ?> , reservation
                </h3>
                <?php
                        $patient_id = $_SESSION['PatientId']; 
                        $query = "SELECT * FROM reservation WHERE reservation_patient_id = '$patient_id' ";
                        $result = mysqli_query($conn, $query);
                        if($row = mysqli_fetch_array($result)){
                            echo '
                            <table class="table table-dark table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <td scope="col">doctor name</td>
                                        <td scope="col">doctor specialty</td>
                                        <td scope="col">price</td>
                                        <td scope="col">reservation date</td>
                                        <td scope="col">cancel reservation</td>
                                    </tr>
                                </thead>
                                <tbody>
                                '; 
                                $doctor_id = $row['reservation_doctor_id'];
                                $queryGetDoctor = "SELECT * FROM doctor WHERE doctorId = '$doctor_id' ";
                                $resultGetDoctor = mysqli_query($conn, $queryGetDoctor);
                                $rowDoctor = mysqli_fetch_array($resultGetDoctor);

                                // show the department name
                                $depart_Id = $rowDoctor['depart_id'];
                                $query_depart = "SELECT * FROM department WHERE depart_id = '$depart_Id'";
                                $result_depart = mysqli_query($conn , $query_depart);

                                while($rowGetDoctor = mysqli_fetch_array($resultGetDoctor)){
                                    echo "
                                    <tr class='text-center'>
                                    <td scope='row'>$rowGetDoctor[doctorName]</td>
                                    <td class='text-center'>$result_depart[depart_name]</td>
                                    <td class='text-center'>$row[reservation_price]</td>
                                    <td class='text-center'>$row[reservation_doctor_date]</td>
                                    <td class='text-center'>
                                        <a href='#' class='btn btn-info'>ok</a>
                                        <a href='#' class='btn btn-danger delete' data-field='city_id' data_id='$row[reservation_id]' data-table='city'>Delete</a>
                                    </td>
                                </tr>
                                    ";
                                }
                        }else{
                            echo "
                            <h5>There are no reservations for you yet</h5>
                        ";
                        }
                    ?>
                    </tbody> 
    
                </table>
            <?php else: ?> 
                <h3>not found any patient</h3>
            <?php endif?>
        </div>
    </div>
</body>
</html>

<?php require_once BLA.'inc/footer.php';?>
<!-- end personal patient  -->

<!-- start personal doctor  -->
<?php
    require_once('../config.php');
    require_once BLA.'inc/nav.php';
    require_once BL.'functions/valid.php';
    require_once BL.'functions/messages.php';
    require_once BL.'functions/db.php';

    if(!$conn){
        dir('Error' . mysqli_connect_error());
    }

    $doctor = isset($_SESSION['doctorName']) && $_SESSION['doctorRole'] == 'doctor' ? $_SESSION['doctorName'] : null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
  .text{
    text-align:center ;
  }
  form {
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
  }
  
  label {
    display: block;
    margin-bottom: 5px;
  }
  
  input[type="text"],
  input[type="file"],
  input[type="textarea"],
  button {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box; /* Ensure padding and border are included in width */
  }
  
  #error{
    padding:5px;
    color:red;
  }
  .Alink{
    width: 100%;
    padding: 10px;
    background-color: #0d6efd;
    border: none;
    border-radius: 3px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  .Alink{
    width: 100%;
    padding: 10px;
    background-color: #0d6efd;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .go_lastPost a{
    text-decoration: none;
  }
</style>

</head>
<body>
<?php
    $error_message = '';
    $success_message = '';
    $doctor_id = $_SESSION['doctorId'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['submit'])){
            $writeOverview = $_POST['writeOverview'];
            $writeHere = $_POST['writeHere'];
            $id = $_POST['doctor_id'];
            $input_date=$_POST['date'];
            $date=date("Y-m-d",strtotime($input_date));
            $image = $_FILES['image'];
            $image_location = $_FILES['image']['tmp_name']; // it's image and extension 
            $image_name = $_FILES['image']['name'];
            $image_up = "image/".$image_name; // it's folder upload inside the image
        
            // insert data to database
            $insert = "INSERT INTO lastpost (lastPost_Image, lastPost_About, lastPost_writeHere , doctor_Id  , lastPost_date) VALUES ('$image_up', '$writeOverview', '$writeHere' , '$id' , '$date')";
            mysqli_query($conn , $insert);
            // Make sure the files are uploaded to folder image 
            if(move_uploaded_file($image_location , 'image/'.$image_name)){
                echo $success_message = "
                <div class='go_lastPost'>
                    <h3>New post created successfully</h3>
                    <p> go to page <a href='./lastPostPage.php'>last post</a></p>
                </div>";
            }else{
                echo $error_message = "No file uploaded it's the error.";
            }
        }
    }
?>
      <div class="container text-center">
        <div class="col-sm-12">
            <h3 class="p-3 bg-primary text-white">
                Welcome <?php echo $_SESSION['doctorName']; ?> , reservation
            </h3>
                    <?php
                        $doctor_id = $_SESSION['doctorId'];
                        $query = "SELECT * FROM reservation WHERE reservation_doctor_id = '$doctor_id' ";
                        $result = mysqli_query($conn, $query);
                        if($row = mysqli_fetch_array($result)){
                            $total_price = 0; // Initialize total price
                            echo '
                            <table class="table table-dark table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <td scope="col">patient name</td>
                                    <td scope="col">patient email</td>
                                    <td scope="col">price</td>
                                    <td scope="col">reservation date</td>
                                    <td scope="col">action</td>
                                </tr>
                            </thead>
                            <tbody>
                            ';
                            
                            $total_price += $row['reservation_price']; // Add reservation price to total
                            $patient_id = $row['reservation_patient_id'];
                            $queryGetPatient = "SELECT * FROM patient WHERE PatientId = '$patient_id' ";
                            $resultGetPatient = mysqli_query($conn, $queryGetPatient);
    
                            while($rowGetPatient = mysqli_fetch_array($resultGetPatient)){
                                echo "
                                <tr class='text-center'>
                                <td scope='row'>$rowGetPatient[patient_name]</td>
                                <td class='text-center'>$rowGetPatient[patient_email]</td>
                                <td class='text-center'>$row[reservation_price]</td>
                                <td class='text-center'>$row[reservation_doctor_date]</td>
                                <td class='text-center'>
                                    <button class='btn btn-danger delete' data-id='<?php echo $row[reservation_id]; ?>'>Delete</button>
                                </td>
                            </tr>
                                ";
                            }

                            echo '
                                <tr class="text-center">
                                    <td colspan="2"><strong>Total Price</strong></td>
                                    <td colspan="3"><strong>' . $total_price . '</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        ';
                        }else{
                            echo "
                                <h5>There are no reservations for you yet</h5>
                            ";
                        }
                    ?>
                    </tbody> 
            </table>
        </div>

        <!-- create new post  -->
        <div class="newPost">
            <h3>Create new post</h3>
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
                <div class="input-group">
                  <input type="file" id="file" name="image" style="display: none;">
                  <label for="file" style="cursor: pointer; color:#0d6efd; font-weight:bold;">Choose Image Post</label>
                </div>
                <div class="input-group">
                    <label for="AboutLecture">Writing an overview of the post</label>
                    <input type="text" id="AboutLecture" name="writeOverview" >
                </div>
                <div class="input-group">
                    <label for="writeHere">Write here</label>
                    <input type="textarea" id="writeHere" name="writeHere">
                </div>
                <div class="input-group">
                    <input type="date" name="date">
                </div>
                <div class="input-group">
                    <a href="posted_I_Created.php" style="text-decoration: none; color:#0d6efd; font-weight:bold;">Posts i created</a>
                    <input type="text" name="doctor_id" value="<?php echo $doctor_id?>" style="display: none;">
                </div>
                <br>
                <button class="Alink" name="submit">New post</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php require_once BLA.'inc/footer.php';?>

<!-- end personal doctor  -->
<!-- start appointment   -->
<?php
    require_once('../../config.php');
    require_once BL.'functions/db.php';
    require_once BL.'functions/messages.php';
    require_once BL.'functions/valid.php';
    require_once BLA.'inc/nav.php';

    if(isset($_POST['submit'])){
        $name = mysqli_real_escape_string($conn, $_POST['Name']);
        $phone = mysqli_real_escape_string($conn, $_POST['Phone']);
        $address = mysqli_real_escape_string($conn, $_POST['Address']);
        $message = mysqli_real_escape_string($conn, $_POST['Message']);
        $rate = intval($_POST['rating']); // Ensuring rating is an integer
        $image = $_FILES['image'];
        $image_location = $_FILES['image']['tmp_name'];
        $image_name = $_FILES['image']['name'];
        $image_up = "image/". $image_name;

        // insert data to database
        $query = "INSERT INTO opinion (name, phone, address , message , rating , image) VALUES ('$name', '$phone', '$address' , '$message' , '$rate' , '$image_up')";
       
        mysqli_query($conn , $query);
        // Make sure the files are uploaded to folder image 
        if(move_uploaded_file($image_location , 'image/'.$image_name)){
            echo '
            <div class="alert alert-success" role="alert">
               Your opinion has been added
            </div>
            <script>
                setTimeout(function() {
                    window.location.href = "../../page/homePage.php";
                }, 1000); // Redirect after 1000 milliseconds (1 seconds)
            </script>  
            ';
        }else{
        echo '
            <div class="alert alert-danger" role="alert">
                There is a mistake      
            </div>
            <script>
                setTimeout(function() {
                    window.location.href = "contactUs.php";
                }, 1000); // Redirect after 1000 milliseconds (1 seconds)
            </script>  
        ';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/appointment.css">
    <style>
        .star{
            font-size: 2em;
            cursor: pointer;
            color: gray;
        }
        .star.selected {
            color: gold;
        }
        .alert {
        position: fixed;
        width: auto;
        top: 20px;
        right: 20px;
        z-index: 1050;
        padding: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
        border-color: #f5c6cb;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<div class='appointment text-center container py-8 mt-5'>
        <h1>Your opinion about the services</h1> 
        <div class='container'>
            <div class='appointCart row'>
                <div class='col-md-8 col-lg-6'>
                    <img src="../../imag/gallery/appointment.png" class="img-fluid"/>
                </div>
                <div class='col-md-4 col-lg-6 z-index-2 mt-5'>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class='row g-3'>
                            <input class='col-md-4' type='text' name="Name" placeholder='Name'/>
                            <input class='col-md-4' type='number' name="Phone" placeholder='Phone' />
                            <input class='col-md-4' type='text' name="Address" placeholder='Address'/>
                            <textarea name="Message" placeholder='Message'></textarea>

                            <div class="d-flex justify-content-around">
                                <div class="d-flex justify-content-center gap-2" style="cursor: pointer;">
                                    <i class="fa-solid fa-user-tie"></i>
                                    <div class="input-group" >
                                        <input type="file" id="file" name="image" required style="display: none;">
                                        <label for="file">Choose Image User</label>
                                    </div>
                                </div>

                                <div id="rating" class="mb-2">
                                    <span class="star" data-value="1">&#9733;</span>
                                    <span class="star" data-value="2">&#9733;</span>
                                    <span class="star" data-value="3">&#9733;</span>
                                    <span class="star" data-value="4">&#9733;</span>
                                    <span class="star" data-value="5">&#9733;</span>
                                    <input type="hidden" name="rating" id="rating-input" required>
                                </div>
                            </div>
                   
                            <button class="btn btn-outline-secondary rounded-pill col-md-12" type="submit" name="submit" fdprocessedid="2znbuu">Send</button>
                    </form>
                </div>
                <ToastContainer/>
            </div>
        </div>
    </div>
    <!-- javascript -->
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const stars = document.querySelectorAll('.star');
            const ratingInput = document.getElementById('rating-input');
            stars.forEach(star => {
                star.addEventListener('click', rateStar);
            });

            function rateStar(event) {
                const selectedStar = event.target;
                const rating = selectedStar.getAttribute('data-value');
                
                stars.forEach(star => {
                    star.classList.remove('selected');
                });

                for (let i = 0; i < rating; i++) {
                    stars[i].classList.add('selected');
                }

                ratingInput.value = rating;
            }
        });
    </script>
</body>
</html>

<!-- end appointment  -->
<!-- start servicePage  -->
<?php
    require_once('../config.php');
    require_once BLA.'inc/nav.php';
    require_once BL.'functions/valid.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* start service */
        .service .cardService{
                margin: 10px;
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 15px;
            }
            .service .textCart{
                background-image: url("../imag/services/header.jpg");
                background-size:cover;
                padding: 20px;
                height: 300px;
            }
            .service .textCart h4{
                color: aliceblue;
                font-size: 50px;
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: 100px;
            }
            .service .cartIcon{
                border: 1px solid black;
                padding: 10px;
                width: 400px;
                height : auto;
            }
            .service .cartIcon img{
                width: 170px;
            }
            .service .card .card-title a{
                text-decoration: none;
                font-size: 18px;
                font-weight: bold;
            }
            .appoint{
                display: flex;
                justify-content: center;
                gap: 10px;
                margin-top: 10px;
            }
            .appoint .text{
                width: 45%;
                margin-top: 5%;
            }
            .appoint .text h5{
           font-size: 15px;
            color: #0d6efd;
            }
    </style>
</head>
<body>
        <div class='service mt-2 mb-2'>
            <div class="container">
                <div class='textCart'>
                    <h4>Service</h4>
                </div>
                <div class="cardService">
                    <div class="card" style="width: 18rem;">
                        <img src="../imag/services/teeth.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><a href="#">Teeth Whitening</a></h5>
                            <p class="card-text">Capitalize on low hanging fruit to identify a ...</p>
                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                        <img src="../imag/services/spinal-column_2563692.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><a href="#">Spinal Surgery</a></h5>
                            <p class="card-text">Capitalize on low hanging fruit to identify a...</p>
                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                        <img src="../imag/services/ray_11505441.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><a href="#">X-Ray Imagery</a></h5>
                            <p class="card-text">Leverage agile frameworks to provide a robust synopsis  ...</p>
                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                        <img  src="../imag/services/scan_2992104.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><a href="#">MRI Check-up</a></h5>
                            <p class="card-text">Capitalize on low hanging fruit to identify a ...</p>
                        </div>
                    </div>
                </div>
                <div class="appoint">
                    <div class="text sm-6 md-6 lg-6">
                        <h3>Make An Appointment To Visit Our Doctor</h3>
                        <p>We are pleased to provide you with a lot of medical services with the best helpful doctors and we wish you a speedy recovery. We are always working to improve your health.
                        </p>
                        <h5>In order to enjoy all the services, you must register your data first</h5>
                    </div>
                    <div class="sm-6 md-6 lg-6">
                        <div class="bg-light rounded d-flex align-items-center p-5 mb-4">
                            <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white" style="width:55px;height:55px;">
                                <i class="fa fa-phone-alt text-primary"></i>
                            </div>
                            <div class="ms-4">
                                <p class="mb-2">Call Us Now</p>
                                <h5 class="mb-0">+012 345 6789</h5>
                            </div>
                        </div>
                            
                        <!-- /////////////// -->
                        <div class="bg-light rounded d-flex align-items-center p-5">
                            <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white" style="width:55px;height:55px;">
                                <i class="fa fa-envelope-open text-primary"></i>
                            </div>
                            <div class="ms-4">
                                <p class="mb-2">Mail Us Now</p>
                                <h5 class="mb-0">MedicalClinic123@gmail.com</h5>
                            </div>
                        </div>

                    </div>
                    </div>
                </div>
            </div>
        </div> 
</body>
</html>

<?php require_once BLA.'inc/footer.php';?>
 
<!-- end servicePage  -->

<!-- start home page  -->
                <!-- start show all doctor -->
                <div>
                    <h1>Doctors</h1>
                    <div class="allDoctors text-center">
                        <?php
                            require_once BL.'functions/db.php';
                            require_once BL.'functions/messages.php';
                            require_once BL.'functions/valid.php';
                            $query = "SELECT * FROM doctor";
                            $result = mysqli_query($conn , $query);
                            while($row = mysqli_fetch_array($result)){
                                // show the department name
                                $depart_Id = $row['depart_id'];
                                $query_depart = "SELECT * FROM department WHERE depart_id = '$depart_Id'";
                                $result_depart = mysqli_query($conn , $query_depart);
                                $row_depart = mysqli_fetch_array($result_depart);

                                echo "
                                <div>
                                    <div class='card' style='width: 18rem;'>
                                        <img src='../admin/dashboard/$row[doctorImage]' class='card-img-top'>
                                        <div class='card-body'>
                                            <h5 class='card-title'>$row[doctorName]</h5>
                                            <p class='card-text'>$row_depart[depart_name]</p>
                                            <p class='card-text'>$row[doctorPhone]</p>
                                            <p class='card-text'>$row[doctorDate]</p>
                                            <p class='card-text'>$row[doctor_booking_price]</p>
                                        </div>
                                    </div>
                                </div>
                                ";
                            }
                        ?>
                        </div>
                </div>
                <!-- end show all doctor -->

                <!-- start last post -->
                <div>
                    <!-- last post -->
                    <h1>last post</h1>
                    <div class="allDoctors">
                        <?php
                            require_once BL.'functions/db.php';
                            require_once BL.'functions/messages.php';
                            require_once BL.'functions/valid.php';
                            $query = "SELECT * FROM lastpost";
                            $result = mysqli_query($conn , $query);
                            while($row = mysqli_fetch_array($result)){
                                $image_path = $row['lastPost_Image'];
                                $About = mb_strimwidth($row['lastPost_About'], 0, 25 , "...");
                                $writeHere = mb_strimwidth($row['lastPost_writeHere'], 0, 70, "...");
                                
                                // Call the doctor to have his name appear
                                $doctor_id = $row['doctor_Id'];
                                $query_doc = "SELECT * FROM doctor WHERE doctorId = '$doctor_id'";
                                $result_doc = mysqli_query($conn,$query_doc);
                                $row_doc = mysqli_fetch_array($result_doc);

                                // Show the department of the doctor
                                $depart_id = $row_doc['depart_id'];
                                $query_depart = "SELECT * FROM department WHERE depart_id = '$depart_id'";
                                $result_depart = mysqli_query($conn,$query_depart);
                                $row_depart = mysqli_fetch_array($result_depart);
                                
                                echo "
                                <div>
                                    <div class='card' style='width: 18rem;'>
                                        <img src='../doctor/$image_path' class='card-img-top'>
                                        <div class='d-flex justify-content-around'>
                                            <p class='card-title'> $row_doc[doctorName]</p>    
                                            <p class='card-title'> $row_depart[depart_name]</p>  
                                        </div>
                                        <div class='card-body'>
                                            <h5 class='card-title'>$About</h5>
                                            <p class='card-text'>$writeHere</p>
                                        </div>
                                    </div>
                                </div>
                                ";
                            }
                        ?>
                        </div>
                </div>
                <!-- ent last post -->

<!-- end home page  -->