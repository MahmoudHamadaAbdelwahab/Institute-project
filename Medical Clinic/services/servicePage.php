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
        /* Custom styles */
        .service .textCart{
            background-image: url("../imag/services/header.jpg");
            background-size: cover;
            padding: 20px;
            height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .service .textCart h4{
            color: aliceblue;
            font-size: 50px;
        }
        .service .cardService{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 5px;
        }
        .service .card{
            width: 18rem;
            margin: 10px;
        }
        .service .card-title a{
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
        }
        .appoint{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 10px;
        }
        .appoint .text{
            flex: 1;
            min-width: 250px;
            margin-top: 5%;
        }
        .appoint .text h5{
            font-size: 15px;
            color: #0d6efd;
        }
        .contact-info{
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: #abb0b4;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .contact-info i{
            font-size: 30px;
            color: #0d6efd;
            margin-right: 15px;
        }
    </style>
</head>
<body>
    <div class="service mt-2 mb-2">
        <div class="container">
            <div class="textCart">
                <h4>Service</h4>
            </div>
            <div class="cardService">
                <div class="card">
                    <img src="../imag/services/teeth.png" class="card-img-top" alt="Teeth Whitening">
                    <div class="card-body">
                        <h5 class="card-title"><a href="#">Teeth Whitening</a></h5>
                        <p class="card-text">Capitalize on low hanging fruit to identify a ...</p>
                    </div>
                </div>
                <div class="card">
                    <img src="../imag/services/spinal-column_2563692.png" class="card-img-top" alt="Spinal Surgery">
                    <div class="card-body">
                        <h5 class="card-title"><a href="#">Spinal Surgery</a></h5>
                        <p class="card-text">Capitalize on low hanging fruit to identify a...</p>
                    </div>
                </div>
                <div class="card">
                    <img src="../imag/services/ray_11505441.png" class="card-img-top" alt="X-Ray Imagery">
                    <div class="card-body">
                        <h5 class="card-title"><a href="#">X-Ray Imagery</a></h5>
                        <p class="card-text">Leverage agile frameworks to provide a robust synopsis...</p>
                    </div>
                </div>
                <div class="card">
                    <img src="../imag/services/scan_2992104.png" class="card-img-top" alt="MRI Check-up">
                    <div class="card-body">
                        <h5 class="card-title"><a href="#">MRI Check-up</a></h5>
                        <p class="card-text">Capitalize on low hanging fruit to identify a ...</p>
                    </div>
                </div>
            </div>
            <div class="appoint">
                <div class="text">
                    <h3>Make An Appointment To Visit Our Doctor</h3>
                    <p>We are pleased to provide you with a lot of medical services with the best helpful doctors and we wish you a speedy recovery. We are always working to improve your health.</p>
                    <h5>In order to enjoy all the services, you must register your data first</h5>
                </div>
                <div class="contact-info">
                    <i class="fa fa-phone-alt text-primary"></i>
                    <div>
                        <p class="mb-2">Call Us Now</p>
                        <h5 class="mb-0">+012 345 6789</h5>
                    </div>
                </div>
                <div class="contact-info">
                    <i class="fa fa-envelope-open text-primary"></i>
                    <div>
                        <p class="mb-2">Mail Us Now</p>
                        <h5 class="mb-0">MedicalClinic123@gmail.com</h5>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php require_once BLA.'inc/footer.php';?>
