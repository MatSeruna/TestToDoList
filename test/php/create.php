<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Подготовка и выполнение SQL-запроса
    $stmt = $pdo->prepare("INSERT INTO tasks (title, description) VALUES (?, ?)");
    $stmt->execute([$title, $description]);

    header("Location: create.php");
    exit; // Рекомендуется добавлять exit после header
}

// Получение списка задач
$stmt = $pdo->query("SELECT title, description, time FROM tasks ORDER BY time DESC");
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>New Task</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <h1>Add New Task</h1>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="title" required>
        <label>Description:</label>
        <textarea name="description"></textarea>
        <button type="submit">Add</button>
    </form>

    <div class="task-list">
        <h2>Task List</h2>
        <?php foreach ($tasks as $task): ?>
            <div class="task">
                <h3><?php echo htmlspecialchars($task['title']); ?></h3>
                <p><?php echo htmlspecialchars($task['description']); ?></p>
                <p class="time"><?php echo $task['time']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="index.php">Back to Task List</a>
</body>
</html>
