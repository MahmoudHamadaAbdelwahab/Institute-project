<?php
    require_once('../config.php');
    require_once BL.'functions/db.php';
    require_once BL.'functions/messages.php';
    require_once BL.'functions/valid.php';
    require_once BLA.'inc/nav.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .container{
            text-align: center;
        }
        .doctors {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            margin: 10px;
        }

        .main{
            width: 50%;
            box-shadow: 1px 1px 10px silver;
            padding: 20px;
            margin: 50px;
            display: flex;
            justify-content: space-around;
            text-align: center;
        }
        .main .image{
            width: 50%;
        }
        .main .text{
            display: flex;
            flex-direction: column;
            gap: 3px;
        }
        .main .text span{
            color: #0d6efd;
            font-size: 20px;
        }
        .goToPage{
            text-decoration: none;
            font-weight: bold;
            color: #0d6efd;
        }
    </style>
</head>
<body>
    <div class="container">
            <h1>Doctors</h1>
            <div class="doctors">
                <?php
                require_once('../config.php');
                require_once BL.'functions/db.php';
                require_once BL.'functions/messages.php';
                require_once BL.'functions/valid.php';
                // Fetch doctors from the database
                $department_id = $_GET['department_id'];

                $sql = "SELECT * FROM doctor WHERE depart_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $department_id);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    echo"
                    <div class='main'>
                        <div class='image'>
                            <img src='../admin/dashboard/$row[doctorImage]' alt='Image' width='100%' height='200'>
                        </div>
                        <div class='text'> 
                            <h5 class='card-title'>$row[doctorName]</h5>
                            <p class='card-text'>$row[doctorPhone]</p>
                            <p class='card-text'>$row[doctorDate]</p>
                            <p class='card-text'>$row[doctor_booking_price]</p>
                        </div>
                    </div>
                   ";
                }
                ?>
            </div>
    </div>
</body>
</html>
<?php require_once BLA.'inc/footer.php'; ?>
