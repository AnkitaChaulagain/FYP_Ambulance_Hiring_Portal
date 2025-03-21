<?php
$conn = new mysqli("localhost", "root", "", "ambulancehiringdbuser");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $conn->query("UPDATE about_us SET title='$title', content='$content' WHERE id=1");
    echo "Updated Successfully!";
}
?>

<form method="post">
    <input type="text" name="title" placeholder="Title" required><br>
    <textarea name="content" placeholder="About Us Content" rows="5" required></textarea><br>
    <button type="submit">Update</button>
</form>
