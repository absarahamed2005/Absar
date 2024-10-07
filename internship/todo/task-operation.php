<?php
include "./config.php";

if (isset($_GET['operation']) && $_GET['operation'] == "getAllTasks") {

    $result = mysqli_query($conn, "SELECT * FROM tasks");

    $response = [];

    if (mysqli_num_rows($result) > 0) {
        $tasks = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $tasks[] = $row; 
        }
        $response['status'] = "success";
        $response['message'] = "Tasks retrieved successfully"; 
        $response['data'] = $tasks;  
    } else {
        $response['status'] = "error";
        $response['message'] = "No data found"; 
    }
    echo json_encode($response);
    exit();  
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['operation']) && $_POST['operation'] == "add" && isset($_POST['task'])) {
        if (!empty($_POST['task'])) {
            $task = mysqli_real_escape_string($conn, $_POST['task']); 
            $result = mysqli_query($conn, "INSERT INTO tasks (description, is_completed) VALUES ('$task', 0)"); 

            if ($result) {
                header("Location: ./?msg=Task added successfully");
            } else {
                header("Location: ./?msg=Operation failed: " . mysqli_error($conn));
            }
        } else {
            header("Location: ./?msg=Task cannot be empty");
        }
        exit;
    }

    if (isset($_POST['operation']) && $_POST['operation'] == "edit" && isset($_POST['task']) && isset($_POST['taskId'])) {
        if (!empty($_POST['task']) && !empty($_POST['taskId'])) {
            $task = mysqli_real_escape_string($conn, $_POST['task']); 
            $taskId = $_POST['taskId'];

            $result = mysqli_query($conn, "UPDATE tasks SET description='$task' WHERE id='$taskId'");

            if ($result) {
                header("Location: ./?msg=Task updated successfully");
            } else {
                header("Location: ./?msg=Operation failed: " . mysqli_error($conn));
            }
        } else {
            header("Location: ./?msg=Task and ID cannot be empty");
        }
        exit();
    }

    if (isset($_POST['operation']) && $_POST['operation'] == "updateStatus" && isset($_POST['taskId'])) {
        $taskId = $_POST['taskId'];

        $result = mysqli_query($conn, "SELECT is_completed FROM tasks WHERE id = '$taskId'");
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $newStatus = (isset($row['is_completed']) && $row['is_completed'] == 1) ? 0 : 1; 
            $updateResult = mysqli_query($conn, "UPDATE tasks SET is_completed = '$newStatus' WHERE id = '$taskId'");
            
            if ($updateResult) {
                echo "Task status updated";
            } else {
                echo "Failed to update task status: " . mysqli_error($conn);
            }
        } else {
            echo "Task not found";
        }
        exit();
    }
}

elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['operation']) && $_GET['operation'] == "delete" && isset($_GET['id'])) {
        if (!empty($_GET['id'])) {
            $id = $_GET['id']; 
            $result = mysqli_query($conn, "DELETE FROM tasks WHERE id='$id'");

            if ($result) {
                header("Location: ./?msg=Deleted successfully");
            } else {
                header("Location: ./?msg=Operation failed: " . mysqli_error($conn));
            }
        } else {
            header("Location: ./?msg=Task ID missing");
        }
        exit;
    } elseif (isset($_GET['operation']) && $_GET['operation'] == "delete") {
        header("Location: ./?msg=Task not found");
        exit;
    }
}
?>
