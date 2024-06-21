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
            .slider_Home img{
                width: 90%;
                height: 90%;
                border-radius: 50%;
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
            /* start card doctor && last post */
            .doc_post {
                display: flex;
                justify-content: space-between;
                margin: 20px;
            }
            .doc_post div {
                position: relative;
                flex: 1;
                text-align: center;
                width: 400px;
            }
            .doc_post img {
                width: 400px;
                height: 200px;
                border: 2px solid #ddd;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                transition: transform 0.2s;
            }
            .doc_post img:hover {
                transform: scale(1.05);
            }
            .overlay-text {
                position: absolute;
                bottom: 10px;
                left: 50%;
                transform: translateX(-50%);
                background-color: rgba(0, 0, 0, 0.5);
                color: white;
                padding: 10px;
                border-radius: 5px;
                font-size: 18px;
                font-weight: bold;
                text-align: center;
            }
            /* end card doctor && last post */
            /* 
            src="../imag/gallery/teamDoc3.png"
             */
        </style>
    </head>
    <body>
        <div class="slider_Home text-center">
            <div class="container">
                <div class="row d-flex justify-content-center align-items-center text-center">
                    <div class="col-sm-5 col-lg-6">
                        <img
                        class="img_doc pt-7 pt-md-0 img-fluid"
                        src="../imag/gallery/MedicalClinic2.png"
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

                <!-- start card doctor && last post -->
                 <div class="doc_post">
                    <div>
                        <a href="../doctor/OurDoctors.php">
                            <img src="../imag/gallery/team_doctor4.jpg" alt="Our Doctors">
                            <div class="overlay-text">Our Doctors</div>
                        </a>
                    </div>
                    <div>
                        <a href="../doctor/lastPostPage.php">
                            <img src="../imag/gallery/nicotine.png" alt="Last Post">
                            <div class="overlay-text">Last Post</div>
                        </a>
                    </div>
                 </div>
                <!-- end card doctor && last post -->

                <!-- start Customer opinion -->
                <h1>Customer Opinion</h1>
                  <?php include('customerOpinion.php')?>   
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
