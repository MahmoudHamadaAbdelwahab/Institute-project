<?php
    $conn = mysqli_connect('localhost','root','','medical_clinic');
    if(!$conn){
        dir('Error' . mysqli_connect_error());
    }

    function db_insert($sql){
        global $conn;
        $result = mysqli_query($conn,$sql);
        if($result){
            return 'added success';
        }else{
            return false;
        }
    }
    
    // function db_insert($sql, $params = []){
        // global $conn;
        // $stmt = mysqli_prepare($conn, $sql);
        // if ($stmt) {
        //     // Bind parameters if provided
        //     if (!empty($params)) {
        //         mysqli_stmt_bind_param($stmt, ...$params);
        //     }
        //     if (mysqli_stmt_execute($stmt)) {
        //         return 'Record added successfully';
        //     } else {
        //         return 'Error executing SQL statement: ' . mysqli_stmt_error($stmt);
        //     }
        //     mysqli_stmt_close($stmt);
        // } else {
        //     return 'Error preparing SQL statement: ' . mysqli_error($conn);
        // }
    //}

    function getRows($table){
        global $conn;
        $sql = "SELECT * FROM '$table' ";
        $result = mysqli_query($conn, $sql);
        if($result){
            $rows = [];
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)){
                    $rows[] = $row;
                }
                return $rows[0];
            }
        }
        return $rows;
    }

    // Function to get a row from the database based on a column value
    function getRow($table, $field, $value){
        global $conn;
        $sql = "SELECT * FROM $table WHERE $field = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $value);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            // mysqli_num_rows() => It queries the row in the database
            if ($result && mysqli_num_rows($result) > 0) {
                return mysqli_fetch_assoc($result);
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

?>
