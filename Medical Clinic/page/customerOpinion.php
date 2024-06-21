<?php
require_once('../config.php');
require_once BLA.'inc/nav.php';
require_once BL.'functions/valid.php';

// Fetch opinions from the database
$sql = "SELECT name, phone, address, message, rating, image FROM opinion";
$result = mysqli_query($conn, $sql);

$opinions = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $opinions[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/appointment.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick-theme.css"/>
    <style>
        .star {
            font-size: 2em;
            cursor: pointer;
            color: gray;
        }
        .star.selected {
            color: gold;
        }
        .slider {
            width: 50%;
            margin: 20px auto;
        }
        .slide {
            border: 1px solid black;
            padding: 10px;
            background-color: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            position: relative;
        }
        .stars {
            margin-block: -7px;
            font-size: 1.5em;
        }
        .quite {
            background-color: white;
            height: auto;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 3px solid black;
            position: relative;
            flex-direction: column;
            text-align: center;
        }
        .quite img {
            border-radius: 50%;
            position: absolute;
            width: 90px;
            height: 90px;
            top: -15px;
            right: calc(50% - 50%);
        }
        .quite .cont {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 10px;
        }
        .quite .cont h3 {
            text-transform: uppercase;
            font-size: 30px;
            margin: 0;
        }
        .quite .cont .title {
            font-size: 25px;
            color: rgb(16, 16, 118);
            margin-bottom: 10px;
        }
        .quite .cont p {
            line-height: 1.7em;
            font-size: 16px;
        }
        .quite .cont .stars {
            font-size: 20px;
            color: yellow;
        }
        @media (max-width: 768px) {
            .slider {
                width: 100%;
            }
            .slide {
                padding: 10px;
            }
            .quite {
                width: 100%;
                padding: 20px;
            }
            .quite img {
                width: 75px;
                height: 75px;
                top: -13px;
                right: calc(10% - 50px);
            }
        }
    </style>
</head>
<body>
<div class="slider" id="opinions-slider">
    <?php foreach ($opinions as $opinion): ?>
        <div class="slide">
            <div class="quite">
                <img src="../admin/admins/<?php echo htmlspecialchars($opinion['image']); ?>" alt="User Image">
                <div class="cont">
                    <h3><?php echo htmlspecialchars($opinion['name']); ?></h3>
                    <div class="title stars">
                        <?php
                        for ($i = 0; $i < 5; $i++) {
                            echo $i < $opinion['rating'] ? '★' : '☆';
                        }
                        ?>
                    </div>
                    <p><?php echo htmlspecialchars($opinion['message']); ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>

<script>
    $(document).ready(function() {
        $('#opinions-slider').slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: true
        });
    });
</script>
</body>
</html>
