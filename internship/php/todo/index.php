<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TO-DO List</title>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<link rel="Stylesheet" href="style.css">    
</head>
<body>
    <div class="absi">
    <h1>To-Do List</h1>
    <form action="./task-operation.php" method="post" id="taskOperation">
        <input type="hidden" name="operation" id="operation" value="add">
        <textarea name="task" id="task" placeholder="Enter your task"></textarea>
        <button type="submit" id="submitBtn">ADD</button>
    </form>

    <ul id="task-list">

    </ul>
    </div>
<script>
    $(document).ready(function(){
        getTasks();  
    });

    function editTaskForm(id) {
        var task = document.getElementById(`task-${id}`).innerText;

        $("#task").val(task);  
        document.getElementById("operation").value = "edit";

        if (!document.querySelector(`input[name='taskId']`)) {
            document.getElementById("taskOperation").innerHTML += `<input type='hidden' name='taskId' value='${id}'>`;
        }
    }

    function changeStatus(id) {
        $.ajax({
            url: './task-operation.php',
            method: 'POST',
            data: {
                operation: "updateStatus", 
                taskId: id
            },
            success: function(data) {
                console.log(data);
                getTasks();  
            },
        });
    }

    function getTasks() {
        $.ajax({
            url: './task-operation.php',
            method: 'GET',
            data: {
                operation: 'getAllTasks'
            },
            success: function(response) {
                var data = JSON.parse(response);
                $('#task-list').empty(); 
                
                if(data.status == "success") {
                    data.data.forEach((element) => {
                        var isCompleted = element.is_completed == 1 ? "style='color:green;'" : "";
                        var task = `<li>
                            <p id='task-${element.id}' ${isCompleted} onclick="changeStatus(${element.id})">
                                ${element.description}
                            </p>
                            <button type='button' onclick="editTaskForm(${element.id})">
                                EDIT
                            </button>
                            <a href='./task-operation.php?operation=delete&id=${element.id}' onclick='return confirm("Are you sure you want to delete this task?")'>
                                DELETE
                            </a>
                        </li>`;
                        $("#task-list").append(task); 
                    });
                } else {
                    alert(data.message);  
                }
            }
        });
    }
</script>
</body>
</html>
