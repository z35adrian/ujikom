<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To Do List</title>
    <link rel="stylesheet" href="{{ asset('bahan/css/style.css') }}">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <!-- Main Card -->
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded" style="background-color: rgba(223, 233, 255, 0.8); ">
                    <div class="card-body">
                        <h2>TODOWZT</h2>
                        <br>
                        <br>
                        <center>
                            <h3 style="font-weight: bold;">Your To Do List</h3>
                        </center>
                        <div class="container mt-4">
                            <div class="row justify-content-center">
                                <!-- Do Column -->
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <div class="card mt-4 border-0 shadow-sm rounded" style="background-color: #0623DB; color: white;">
                                            <div class="card-body">
                                                <h4>Do</h4>
                                                <ul id="unfinished-list" class="list-group">
                                                    <!-- Sample Task -->
                                                </ul>
                                                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#popupCard">
                                                    <i class="bi bi-plus-circle-fill"></i> Add New Task
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Done Column -->
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <div class="card mt-4 border-0 shadow-sm rounded" style="background-color: #0623DB; color: white;">
                                            <div class="card-body">
                                                <h4>Done</h4>
                                                <ul id="finished-list" class="list-group">
                                                    <!-- Finished tasks will appear here -->
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal (Popup Card) -->
        <div class="modal fade" id="popupCard" tabindex="-1" aria-labelledby="popupCardLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" style="color: black" id="popupCardLabel">Add New Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form id="task-form">
                            <div class="form-group">
                                <label class="font-weight-bold">Task</label>
                                <input type="text" class="form-control" id="task-name" placeholder="Enter Task" required>
                            </div>
                            <div class="form-group mt-3">
                                <label class="font-weight-bold">Deadline</label>
                                <input type="date" class="form-control" id="task-deadline" required>
                            </div>
                            <div class="form-group mt-3">
                                <label class="font-weight-bold">Priority</label>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="priority" name="priority" value="priority">
                                    <label for="priority" class="form-check-label">Priority</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="priority-no" name="priority" value="no">
                                    <label for="priority-no" class="form-check-label">no</label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="addTask()">Add Task</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('bahan/js/script.js') }}"></script>

    <script>
        // Function to move task between cards (Do <-> Done)
        function moveTask(checkbox) {
            const taskItem = checkbox.closest('li');
            const finishedList = document.getElementById('finished-list');
            const unfinishedList = document.getElementById('unfinished-list');

            if (checkbox.checked) {
                finishedList.appendChild(taskItem);
            } else {
                unfinishedList.appendChild(taskItem);
            }
        }

        // Function to add a new task
        function addTask() {
            const taskName = document.getElementById('task-name').value;
            const taskDeadline = document.getElementById('task-deadline').value;
            const taskPriority = document.querySelector('input[name="priority"]:checked')?.value;

            if (taskName && taskDeadline && taskPriority) {
                const unfinishedList = document.getElementById('unfinished-list');

                // Create new list item
                const newTaskItem = document.createElement('li');
                newTaskItem.classList.add('list-group-item');

                // Create checkbox and label
                const newCheckbox = document.createElement('input');
                newCheckbox.type = 'checkbox';
                newCheckbox.classList.add('form-check-input');
                newCheckbox.onclick = function() { moveTask(this); };

                const newLabel = document.createElement('label');
                newLabel.classList.add('form-check-label');
                newLabel.textContent = `${taskName} - ${taskDeadline} - ${taskPriority.charAt(0).toUpperCase() + taskPriority.slice(1)}`;

                // Create delete icon
                const deleteButton = document.createElement('button');
                deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'ms-3');
                deleteButton.innerHTML = '<i class="bi bi-trash"></i>'; // Icon for delete
                deleteButton.onclick = function() { deleteTask(newTaskItem); };

                // Append checkbox, label, and delete icon to the list item
                newTaskItem.appendChild(newCheckbox);
                newTaskItem.appendChild(newLabel);
                newTaskItem.appendChild(deleteButton);

                // Add task to the Unfinished Tasks list
                unfinishedList.appendChild(newTaskItem);

                // Clear the input fields
                document.getElementById('task-name').value = '';
                document.getElementById('task-deadline').value = '';
                document.querySelector('input[name="priority"]:checked').checked = false;

                // Close the modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('popupCard'));
                modal.hide();
            } else {
                alert('Please fill all fields before adding the task.');
            }
        }

        // Function to delete task
        function deleteTask(taskItem) {
            taskItem.remove();
        }
    </script>
</body>
</html>
