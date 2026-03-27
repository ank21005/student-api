<?php
include 'db.php';

$method = $_SERVER['REQUEST_METHOD'];

// GET → Fetch all students
if ($method == 'GET') {
    $result = $conn->query("SELECT * FROM students");
    echo json_encode($result->fetch_all(MYSQLI_ASSOC));
}

// POST → Add new student
if ($method == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $name = $data['name'];
    $email = $data['email'];
    $course = $data['course'];

    $conn->query("INSERT INTO students (name, email, course) 
                  VALUES ('$name', '$email', '$course')");

    echo json_encode(["message" => "Student added"]);
}

// DELETE → Delete student
if ($method == 'DELETE') {
    $id = $_GET['id'];

    $conn->query("DELETE FROM students WHERE id=$id");

    echo json_encode(["message" => "Student deleted"]);
}
?>

