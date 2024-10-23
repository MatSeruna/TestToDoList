<?php
include 'db.php';

$stmt = $pdo->query("SELECT * FROM tasks");
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>ToDoList</title>
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
        <meta charset="utf-8" />
    </head>
    <body>
        <h1>ToDoList</h1>
        <div class="task-list">
        <?php foreach ($tasks as $task): ?>
            <div class="task">
                <h3><?php echo htmlspecialchars($task['title']); ?></h3>
                <p><?php echo htmlspecialchars($task['description']); ?></p>
                <p class="time"><?php echo $task['time']; ?></p>
                <a href="update.php?id=<?php echo $task['id']; ?>">Edit</a>
                <a href="delete.php?id=<?= $task['id'] ?>">Delete</a>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="create.php" class="button">Add New Task</a>
</body>
</html>