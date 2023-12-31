<?php
include('header.php');
include('admin/includes/header.php');
include('admin/includes/sidebar.php');
include('admin/includes/topbar.php');
include('config.php');

$limit = 3;
if(isset($_GET['page'])){
  
  $getpgno = $_GET['page'];
}else{
  $getpgno = 1;
}
$offset = ($getpgno - 1) * $limit;

$agent_email = $_SESSION['useremail'];

$fetch = "SELECT * FROM `add` WHERE email ='$agent_email'";
$query=mysqli_query($connection , $fetch);
if(mysqli_num_rows($query) > 0){
   while ($row = mysqli_fetch_assoc($query)) {
  $row1 = $row['company']; 
  $row2 = $row['city']; 
}
}

$fetch = "SELECT * FROM `form` where scompany = '$row1' AND city ='$row2' AND status = 'In Progress' order by fid desc limit {$offset}, {$limit}";

$data = mysqli_query($connection, $fetch);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Panel</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/customstyle.css">

</head> 
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
/>
</body>
 <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-left">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <h2>All In Progress Courier Detail</h2>
                <hr>
            <table class="table table-warning">
                <thead class="bg-warning p-2 text-dark bg-opacity-10" style="opacity: 75%;">
                    <tr>
                    <th scope="col">Company Name</th>
                    <th scope="col">Residential Address</th>
                    <th scope="col">Shipment Address</th>
                    <th scope="col">status</th>
                    <th scope="col">city</th>
                    <th scope="col">Deliver/progress</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = mysqli_fetch_assoc($data)) {
                    ?>
                    <tr>
                      <td><?php echo $row ['scompany']?></td>
                      <td><?php echo $row ['raddress']?></td>
                      <td><?php echo $row ['saddress']?></td>
                      <td><?php echo $row ['city']?></td>
                      <td><?php echo $row ['status']?></td>
                      <td ><a href="del.php?fid=<?php echo $row['fid'];?>" class="btn btn-light">Click Here When Courier Deliver</a></td>
                  </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>


<?php
$fetchpage = "SELECT * from form";
$query = mysqli_query($connection, $fetchpage);

  if(mysqli_num_rows($query) > 0){
    $totalRecords = mysqli_num_rows($query);
    $totalpages = ceil($totalRecords / $limit);
    echo '<ul class="pagination">';
    if($getpgno > 1){
      echo '<li class="page-item"><a class="page-link" href="deliver.php?page='.($getpgno - 1).'">prev</a></li>';

    }
    for($i = 1; $i <= $totalpages; $i++){
      $active = $i == $getpgno? "active" : "";
      echo '<li class="'.$active.' page-item"><a class="page-link" href="deliver.php?page='.$i.'">'.$i.'</a></li>';
    }
    if($getpgno < $totalpages){
      echo '<li class="page-item"><a class="page-link" href="deliver.php?page='.($getpgno + 1).'">next</a></li>';
    }

  }
  ?>
            </div>

        </div>

    </div>


</body>

</html>

<?php
include('admin/includes/footer.php');


?>
