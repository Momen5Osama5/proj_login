<?php
include 'index.php';

?>



<!DOCTYPE html>
<html>

<head>
    <title> Manage users </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        .update-button {
            background-color: #902aa5;
            border: none;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
        }

        h1 {
            
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

</head>

<body>

    <h1> Show</h1>
    <div class="container my-5">
    </div>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">role</th>

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
                    $email = $row['email'];
                    $role = $row['role'];
                    echo '<tr>
    <th scope="row">' . $id . '</th>
    <td>' . $name . '</td>
    <td>' . $email . '</td>
    <td>' . $role . '</td>
          
    
    </tr>';
                }
            }
            ?>
        </tbody>

    </table>
</body>

</html>