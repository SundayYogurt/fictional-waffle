<!--<!DOCTYPE html>-->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="blackground.css">
    <title>User Registration 265</title>
    <style type="text/css">
        img {
            transition: transform 0.25s ease;
        }

        img:hover {
            -webkit-transform: scale(1.5);
            /* or some other value */
            transform: scale(1.5);
        }
    </style>


</head>

<body>
    <?php
    require 'connect.php';

    $sql_select = 'SELECT * FROM tbl_menu ORDER BY MenuID';
    $stmt_s = $conn->prepare($sql_select);
    $stmt_s->execute();

    if (isset($_POST['submit'])) {
        // echo "oooo";
        if (!empty($_POST['FoodName'])) {
            echo "FoodName". $_POST['FoodName'];
            $uploadFile = $_FILES['Picture']['name'];
            $tmpFile = $_FILES['Picture']['tmp_name'];
            echo " upload file = " . $uploadFile;
            echo " tmp file = " . $tmpFile;


            $sql = "insert into tbl_food(FoodName,Price,Picture,MenuID)
							values (:FoodName, :Price, :Picture, :MenuID)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':FoodName', $_POST['FoodName']);
            echo "FoodName" . $_POST['FoodName'];
            $stmt->bindParam(':Price', $_POST['Price']);
            $stmt->bindParam(':Picture', $uploadFile);
            $stmt->bindParam(':MenuID', $_POST['MenuID']);
            



            $fullpath = "./Picture/" . $uploadFile;
            move_uploaded_file($tmpFile, $fullpath);

            echo '
                <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

            try {
                if ($stmt->execute()) :
                    echo '
                        <script type="text/javascript">        
                        $(document).ready(function(){
                    
                            swal({
                                title: "Success!",
                                text: "Successfuly add customer",
                                type: "success",
                                timer: 2500,
                                showConfirmButton: "ok"
                            }, function(){
                                    window.location.href = "index.php";
                            });
                        });                    
                        </script>
                    ';
                else :
                    
   echo '<script type="text/javascript">
            $(document).ready(function(){
              Swal({
                title: "ไม่สำเร็จ",
                text: "ไม่สามารถลบได้",
                icon: "warning",
                confirmButtonText: "ok",
              }).then(function(){
                window.location.href = "index.php";
              });
            });
          </script>';


                endif;
                // echo $message;
            } catch (PDOException $e) {
                echo 'Fail! ' . $e;
            }
            $conn = null;
        }
    }
    ?>




    <div class="container justify-content-center align-center-item">
        <div class="row">
            <div class="col-md-4"> <br>
            <div class="row g-3">
            <div class="form-group">
                <h3>เพิ่มรายการอาหาร</h3>
                <form action="AddFood_DB.php" method="POST" enctype="multipart/form-data">
                    <input type="text" class="form-control" placeholder="FoodName" name="FoodName" required>
                    <br> <br>
                    <input type="number" class="form-control" placeholder="Price" name="Price">
                    <br> <br>
                    <label>รหัสเมนู</label>
                    <select name="MenuID" class="form-control">
                        <?php
                        while ($t = $stmt_s->fetch(PDO::FETCH_ASSOC)) :
                        ?>
                            <option value="<?php echo $t['MenuID'] ?>">
                                <?php echo $t['MenuName'] ?>
                            </option>

                        <?php

                        endwhile;
                        ?>
                    </select>
                    <br> <br>
                    แนบรูปภาพ:
                    <input type="file" name="Picture" class="form-control" required>
                    <br><br>
                    <input type="submit" value="Submit" name="submit" class="btn btn-success" />
                </form>
            </div>
        </div>
    </div>
                    </div>
                    </div>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#foodTable').DataTable();
        });
    </script>



</body>

</html>