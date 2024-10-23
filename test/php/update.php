<?php
include 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ?");
$stmt->execute([$id]);
$task = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("UPDATE tasks SET title = ?, description = ? Where id = ?");
    $stmt->execute([$title, $description, $id]);
    
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <h1>Edit Task</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
        <label>Name:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>
        <label>Description:</label>
        <textarea name="description"><?php echo htmlspecialchars($task['description']); ?></textarea>
        <button type="submit">Update</button>
    </form>
    <a href="index.php">Back to Task List</a>
</body>
</html>