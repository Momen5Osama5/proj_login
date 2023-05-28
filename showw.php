<?php
include 'index.php';

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>mange users</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: sans-serif;
    }

    .table-container {
      padding: 0 10%;
      margin: 40px auto 0;
    }

    h1 {
      text-align: center;
      margin-bottom: 40px;
    }
  </style>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

</head>

<body>

  <div class="table-container">
    <h1> Manage users</h1>
  </div>
  <div class="container my-5">
  </div>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">id</th>
        <th scope="col">Name</th>
        <th scope="col">Show</th>
        <th scope="col">update</th>
        <th scope="col">delete</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "select * from user";
      $result = mysqli_query($connt, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
          $id = $row['id'];
          $name = $row['name'];
          echo '<tr>
    <th scope="row">' . $id . '</th>
    <td>' . $name . '</td>
    <td>
    <button  class="btn btn-primary" ><a href="show.php"class="text-light">Show</a></button></td>
    <td><button class="btn btn-success ">  <a href="update.php?id=' . $id . ' "  class="text-light">Update</a></button></td>
    <td><button class="btn btn-danger ">   <a href="delete.php?deleteid=' . $id . '  "  class="text-light">Delete</a></button></td>
          
    
    </tr>';
        }
      }
      ?>


    </tbody>
  </table>
  </div>


</body>

</html>