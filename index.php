<?php
  $conn = mysqli_connect("localhost","root","","database_1");
  
  if(isset($_POST['add'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $add = $_POST['address'];
    $desc = $_POST['desc'];
    if($name=="" || $email=="" || $pass=="" || $add=="" || $desc==""){
        header("Location:index.php?error=1");
        die();
    }
    $sql=" INSERT INTO `users`(`Name`, `Email`, `Password`, `Address`, `Description`) VALUES ('$name','$email','$pass','$add','$desc')";
    mysqli_query($conn,$sql);
    header("Location:index.php");
  }
  if(isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    $sql = "DELETE FROM `users` WHERE Id = $id";
    mysqli_query($conn,$sql);
  }
  if(isset($_POST['updt'])){
    $id = $_POST['edit'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $add = $_POST['address'];
    $desc = $_POST['desc'];
    if($name=="" || $email=="" || $pass=="" || $add=="" || $desc==""){
        header("Location:index.php?error=1");
        die();
    }
    $sql="UPDATE `users` SET `Name`='$name',`Email`='$email',`Password`='$pass',`Address`='$add',`Description`='$desc' WHERE Id=$id ";
    mysqli_query($conn,$sql);
   
 }
 if(isset($_GET['edit_id'])){
    $id = $_GET['edit_id'];
    $fetch = "SELECT * FROM `users` WHERE Id=$id";
    $query = mysqli_query($conn,$fetch);
    $row = mysqli_fetch_assoc($query);
 }
 if(isset($_POST['clr'])){
    $sql ="DELETE FROM `users`";
    mysqli_query($conn,$sql);
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="style.css">
</head>
    <body>
    <section class="fxt-template-animation fxt-template-layout8" data-bg-image="image/cannabis.jpg">
        <nav class="navbar bg-success">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Submission Form</span>
        </div>
        </nav>
        <div class="container">
        <?php 
        if(isset($_GET['error'])){
            echo '<div class="alert alert-danger" role="alert">
            Oops! you left fields Empty
            </div>';
        }
        ?>
        <?php
        if(isset($_GET['edit_id'])){?>
            <form action="" method="post">
                 <input type="hidden" name="edit" value ="<?php echo $_GET['edit_id']; ?>">
            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">UserName</label>
            <input type="Username" name="name" class="form-control" id="exampleFormControlInput1" placeholder="name" value="<?php echo $row['Name']?>" required>
            </div>

            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" value="<?php echo $row['Email']?>" required>
            </div>

            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Password</label>
            <input type="password" name="pass" class="form-control" id="exampleFormControlInput1" placeholder="*******" value="<?php echo $row['Password']?>" required>
            </div>

            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Address</label>
            <input type="Address" name="address" class="form-control" id="exampleFormControlInput1" placeholder="place you live in" value="<?php echo $row['Address']?>" required>
            </div>

            <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3" value="<?php echo $row['Description']?>"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="updt">Update List</button>
        <?php }else{?>
            
            <form action="" method="post">
            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">UserName</label>
            <input type="Username" name="name" class="form-control" id="exampleFormControlInput1" placeholder="name" >
            </div>

            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" >
            </div>

            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Password</label>
            <input type="password" name="pass" class="form-control" id="exampleFormControlInput1" placeholder="*******" >
            </div>

            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Address</label>
            <input type="Address" name="address" class="form-control" id="exampleFormControlInput1" placeholder="place you live in" >
            </div>

            <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="add">Add to list</button> 
            <button type="submit" class="btn btn-danger" name="clr">Clear List</button>
            <?php }?>

            </form>
        </div>
        <div class="container">
          <table class="table table-success table-striped">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Address</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <?php
            $fetch_sql = "SELECT * FROM `users`";
            $fetch_query = mysqli_query($conn,$fetch_sql);
            while($row = mysqli_fetch_assoc($fetch_query)){
                echo'
                <tbody>
                <tr>
                <th scope="row">'.$row['Id'].'</th>
                <td>'.$row['Name'].'</td>
                <td>'.$row['Email'].'</td>
                <td>'.$row['Password'].'</td>
                <td>'.$row['Address'].'</td>
                <td>'.$row['Description'].'</td>
                <td>
                    <a href="index.php?edit_id='.$row['Id'].'"  ><button type="submit" class="btn btn-primary" name="add">Edit</button></a>
                    <a href="index.php?delete_id='.$row['Id'].'"  ><button type="submit" class="btn btn-danger" name="add">Delete</button></a>
                </td>
                </tr>
               </tbody>';
            }
            ?>
            
          </table>
        </div>
    </section>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="index.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
</body>
</html>





<!-- INSERT INTO `users`(`Id`, `Name`, `Email`, `Password`, `Address`, `Description`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]') -->