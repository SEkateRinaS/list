<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
    $errors = "";
    $db = mysqli_connect('localhost', 'root', '', 'sb');
    if (isset($_POST['submit'])) {
        $task = $_POST['task'];
        if (empty($task)){
            $errors = "Введите текст";
        }
        else{
        mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
        header('Location: profile.php');
        }
    }
if (isset($_GET['del_task'])) {
    $id = $_GET['del_task'];
    mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
    header('Location: profile.php');
}

    $task = mysqli_query($db,"SELECT * FROM tasks");
?>
<!doctype html>
<html lang = "en" class = "light">
<head>
    <title>TODO LIST</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="wrapper">
        <div class="themes">
            <label> <input type="radio" name="theme" value="light" checkdate>Light</label>
            <label> <input type="radio" name="theme" value="dark" checkdate>Dark</label>
        </div>
    </div>
</body>
    
    <div class="heading">
        <h2> TODO LIST</h2>
    </div>
    <form method="POST" action="profile.php">
    <?php if (isset($errors)) { ?>
        <p><?php echo $errors;?></p>
    <?php } ?>
        <input type="text" name="task" class="task_input">
        <button type="submit" class="add_btn" name="submit">Add Task</button>
    </form>

    <table>
        <thead>
            <tr>
               <th>N</th> 
               <th>Task</th>
               <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php  $i = 1; while ($row = mysqli_fetch_array($task)) { ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td class="task"><?php echo $row['task']; ?></td>
                <td class="delete">
                    <a href="profile.php?del_task = <?php echo $row['id']; ?>">x</a>
                </td>
            </tr>
            <?php $i++;} ?>
        </tbody>
    </table>
    <form>
        <a href="vendor/logout.php" class="logout">Выход</a>
    </form>
                
</html>