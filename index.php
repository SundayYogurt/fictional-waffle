<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="Picture.css">

    <title>CRUD Food Information with Enlarge Image</title>

</head>

<body>
    <div class="blackground">
    <div class="container">
        <div class="row">
            <div class="col-md-12"> <br>
                <h3>รายชื่อลูกค้า <a href="AddFood_DB.php" class="btn btn-info float-end">+เพิ่มข้อมูล</a> </h3> <br/>
                <table id="FoodTable" class="display-table table-dark table-striped table-responsive table-bordered table table-hover vw-50 vh-50">

                    <thead align="center">
                        <tr>
                            <th width="10%">รหัสอาหาร</th>
                            <th width="20%">ชื่ออาหาร</th>
                            <th width="15%">ราคา</th>
                            <th width="10%">ภาพ</th>
                            <th width="10%">ประเภทอาหาร</th>
                            <th width="5%">แก้ไข</th>
                            <th width="5%">ลบ</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                        require 'connect.php';
                        $sql =
                            'SELECT * FROM tbl_food f, tbl_menu m WHERE f.MenuID = m.MenuID';
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach ($result as $r) { ?>
                            <tr>
                                <td><?= $r['FoodID'] ?></td>
                                <td><?= $r['FoodName'] ?></td>
                                <td><?= $r['Price'] ?></td>
                                <div class="boxsize">
                                <td><img src="./Picture/<?= $r['Picture']; ?>" width="80px" height="80px" alt="image" class="box" onclick="enlargeImg()" id="img1" ></td>
                        </div>
                                 <td><?= $r['MenuID'] ?></td>
                                

                                <td><a href="updateform.php?FoodID=<?= $r['FoodID'] ?>" class="btn btn-warning btn-sm">แก้ไข</a></td>
                                <td><a href="delete.php?FoodID=<?= $r['FoodID'] ?>" class="btn btn-danger btn-sm " data-toggle="modal" data-target="#ModalCenter" onclick="return confirm('ยืนยันการลบข้อมูล !!');">ลบ</a></td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
                        </div>

    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#FoodTable').DataTable();
        });
    </script>
    

</body>

</html>