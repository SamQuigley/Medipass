
<?php

    include ('config.php');

    $patientId = $_POST['patientId'];
    $sql = "SELECT medicalrecord. * , physician.name, physician.surname
            FROM medicalrecord
            INNER JOIN physician ON medicalrecord.physicianId = physician.physicianId
            WHERE medicalrecord.patientId = '$patientId'
            Order By medicalrecord.recordId Desc
            LIMIT 0 , 30";
    

                                                        //Create local variable, assign sql statement.
    $result = $connection->query($sql);                                                         //Query database using the local variable from above(contains sql statement).
        
        if ($result->num_rows > 0) {                                                            //If statement, Enter into statement if there are more than zero rows.
            
            $MultiDimArray = array();                                                           //Create local variable, assign an array list.
            while($row = mysqli_fetch_array($result)){                                          //While loop, iterates through the resulting rows.
                
                $MultiDimArray[] = array ( 'recordId' => $row['0'], 'case' => $row['3'], 'date' => $row['6'], 'physicianName' => $row['7'], 'physicianSurname'=> $row['8']);   //create an array of arrays which would be each row.
            }
            echo json_encode($MultiDimArray);                                                   //echo the result and encode into json format ready for access for the patients table on physician dahsboard.
            }else {                                                                             // else, there are zero patients in patient table.
            echo 0;                                                                   //echo zero patients
        }
        $connection->close();
    ?>
    
    