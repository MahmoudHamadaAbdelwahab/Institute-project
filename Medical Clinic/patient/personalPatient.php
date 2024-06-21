<?php
require_once('../config.php');
require_once BLA.'inc/nav.php';
require_once BL.'functions/valid.php';
require_once BL.'functions/db.php';

$patient = isset($_SESSION['patient_name']) && ($_SESSION['patient_role'] == 'patient' || $_SESSION['patient_role'] == '') ? $_SESSION['patient_name'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Reservations</title>
    <link rel="stylesheet" href="path/to/your/css/file.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container text-center">
        <div class="col-sm-12">
            <?php if(isset($_SESSION['patient_name'])): ?>
                <h3 class="p-3 bg-primary text-white">
                    Welcome <?php echo $_SESSION['patient_name']; ?>, reservation
                </h3>
                <?php
                    $patient_id = $_SESSION['PatientId'];
                    $query = "SELECT * FROM reservation WHERE reservation_patient_id = '$patient_id'";
                    $result = mysqli_query($conn, $query);

                    if(mysqli_num_rows($result) > 0):
                        $total_reservation_price = 0; // Initialize total reservation price
                ?>
                    <table class="table table-dark table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Doctor Name</th>
                                <th scope="col">Doctor Specialty</th>
                                <th scope="col">Price</th>
                                <th scope="col">Reservation Date</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while($row = mysqli_fetch_array($result)): ?>
                            <?php
                                $doctor_id = $row['reservation_doctor_id'];
                                $queryGetDoctor = "SELECT * FROM doctor WHERE doctorId = '$doctor_id'";
                                $resultGetDoctor = mysqli_query($conn, $queryGetDoctor);
                                $rowDoctor = mysqli_fetch_array($resultGetDoctor);

                                // show the department name
                                $depart_Id = $rowDoctor['depart_id'];
                                $query_depart = "SELECT * FROM department WHERE depart_id = '$depart_Id'";
                                $result_depart = mysqli_query($conn, $query_depart);
                                $rowDepart = mysqli_fetch_array($result_depart);

                                $total_reservation_price += $row['reservation_price']; // Add reservation price to total
                            ?>
                            <tr class='text-center'>
                                <td scope='row'><?php echo $rowDoctor['doctorName']; ?></td>
                                <td class='text-center'><?php echo $rowDepart['depart_name']; ?></td>
                                <td class='text-center'><?php echo $row['reservation_price']; ?></td>
                                <td class='text-center'><?php echo $row['reservation_doctor_date']; ?></td>
                                <td class='text-center'>
                                    <button class='btn btn-danger delete' data-id='<?php echo $row['reservation_id']; ?>'>Delete</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        <tr class='text-center'>
                            <td colspan="2"><strong>Total Reservation Price</strong></td>
                            <td class='text-center'><strong><?php echo $total_reservation_price; ?></strong></td>
                            <td colspan="2"></td>
                        </tr>
                        </tbody>
                    </table>
                <?php else: ?>
                    <h5>There are no reservations for you yet</h5>
                <?php endif; ?>
            <?php else: ?> 
                <h3>Not found any patient</h3>
            <?php endif; ?>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('.delete').on('click', function(){
                var reservationId = $(this).data('id');
                var row = $(this).closest('tr');
                $.ajax({
                    url: 'delete_reservation.php',
                    type: 'POST',
                    data: { reservation_id: reservationId },
                    success: function(response){
                        if(response == 'success'){
                            row.remove();
                            location.reload(); // Reload the page to update the total reservation price
                        } else {
                            alert('Failed to delete the reservation.');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>

<?php require_once BLA.'inc/footer.php'; ?>
