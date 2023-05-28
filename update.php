<?php
include 'index.php';
//if(isset($_GET['eid'])){
if (isset($_GET['id'])) {
    $edit = $_GET['id'];
    $sq = "select * from user where id='$edit'";
    $result = mysqli_query($connt, $sq);
    /*if($result && $result->num_rows == 1){
   $row=$result->fetch_assoc();
   $id=$row['id'];
   $name=$row['name'];
   $role=$row['role'];
   $email=$row['email'];
   }*/
    while ($row = mysqli_fetch_array($result)) {
        $uid = $row['id'];
        $name = $row['name'];
        $role = $row['role'];
        $email = $row['email'];
    }
} else {
    echo "faild";
}

if (isset($_POST['submit'])) {
    $edit = $_GET['id'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $sql = "update user set name='$name',email='$email',role='$role' 
   where id=$edit";
    echo $sql;
    $result = mysqli_query($connt, $sql);
    if ($result) {
        echo "update sussfull";
        header('location:shows.php');
    } else {
        echo " faild update";
    }
}










?>





<!DOCTYPE html>
<html>

<head>
    <title>update</title>
    <style>
        /* تنسيق النموذج */
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
        }

        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2> Update</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?php echo $edit ?>" method="post">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>

            <label for="email"> Email</label>
            <input type="email" id="email" name="email" required>

            <label for="role">Role</label>
            <select id="role" name="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>

            </select>

            <input type="submit" name="submit" value="update">
        </form>
    </div>
</body>

</html>