<?php

    $errors="";
    
    //connection a la BD
    $db=mysqli_connect('localhost','root','landry1928','todolist');

    if(isset($_POST['submit'])){
        $task=$_POST['task'];
        if(empty($task)){
            $errors="veuillez entrer quelque chose";
        }else{
            
        mysqli_query($db,"INSERT INTO tasks (task)VALUES ('$task')");
        header('location:index.php');

        }

    }

    if(isset($_GET['del'])){
        $id=$_GET['del'];
        mysqli_query($db,"DELETE FROM tasks WHERE id=$id");
        header('location:index.php');
    }

    $tasks=mysqli_query($db,"SELECT * FROM tasks");



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width, initial-scale=1.0">
    <title>Todo list </title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="heading">
        <h2> ToDo List</h2>
    </div>
    <form action="index.php" method="POST" >
        <?php  if(isset($errors)) { ?>
            <p><?php echo $errors; ?></p>
        <?php } ?>
        <input type="text" name="task" placeholder="description tache" class="task_input">
        <button type="submit" name="submit" class="sub_but">Ajouter</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>N</th>
                <th>Tache</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $i=1 ;while($row = mysqli_fetch_array($tasks)){ ?>
            <tr>
                <td class="num"><?php echo $i; ?></td>
                <td class="task"><?php echo $row['task']; ?></td>
                <td class="del">
                    <a href="index.php ? del=<?php echo $row['id']; ?>">x</a>
                </td>
            </tr>

        <?php $i++; }?>
        </tbody>
    </table>
    
</body>
</html>