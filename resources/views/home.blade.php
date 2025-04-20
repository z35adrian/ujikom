<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>To Do List</title>

    <link rel="stylesheet" href="{{ asset('bahan/css/style.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
</head>
<body style="background-color: #f4f8ff;">
    <div class="container mt-5">
        <div class="card border-0 shadow rounded" style="background-color: rgba(223, 233, 255, 0.9);">
            <div class="card-body">
                <h2 class="text-primary text-center fw-bold">TODOWZT</h2>
                <hr />
                <h3 class="text-center fw-semibold mb-4">Your To Do List</h3>

                {{-- Flash Message --}}
                @if(session('success'))
                    <div class="alert alert-success text-center">{{ session('success') }}</div>
                @endif

                <div class="row justify-content-center">
                    <div class="col-md-5 col-lg-4 mb-4">
                        <div class="card border-0 shadow-sm rounded" style="background-color: #0623DB; color: white;">
                            <div class="card-body">
                                <h4 class="fw-bold">Do</h4>
                                <ul class="list-group list-group-flush mt-3">
                                    @foreach ($tasks->where('completed', false) as $task)
                                        <li class="list-group-item d-flex align-items-center justify-content-between">
                                            <form action="{{ route('task.update', $task->id) }}" method="POST" class="d-flex align-items-center w-100 justify-content-between">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-check w-100">
                                                    <input type="checkbox" class="form-check-input me-2" name="completed" value="1" onchange="this.form.submit()" />
                                                    <label class="form-check-label text-sm" style="font-size:0.9rem;">
                                                        {{ $task->task_name }} 
                                                        <br />
                                                        <small class="text-muted">{{ $task->deadline }}</small> -
                                                        <small class="text-muted">{{ $task->priority ? 'Priority' : 'Normal' }}</small>
                                                    </label>
                                                </div>
                                            </form>
                                
                                            <button type="button" class="btn btn-sm btn-warning ms-2" onclick="editTask({{ $task->id }}, '{{ $task->task_name }}', '{{ $task->deadline }}', '{{ $task->priority }}')">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                
                                            <form id="delete-form-{{ $task->id }}" action="{{ route('task.destroy', $task->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button type="button" class="btn btn-sm btn-danger ms-2" onclick="confirmDelete({{ $task->id }})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                                

                                <button type="button" class="btn btn-light mt-4 w-100" data-bs-toggle="modal" data-bs-target="#popupCard">
                                    <i class="bi bi-plus-circle-fill me-2"></i>Add New Task
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 col-lg-4 mb-4">
                        <div class="card border-0 shadow-sm rounded" style="background-color: #198754; color: white;">
                            <div class="card-body">
                                <h4 class="fw-bold">Done</h4>
                                <ul class="list-group list-group-flush mt-3">
                                    @foreach ($tasks->where('completed', true) as $task)
                                    <li class="list-group-item d-flex align-items-center justify-content-between">
                                        <form action="{{ route('task.update', $task->id) }}" method="POST" class="d-flex w-100 align-items-center">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-check w-100">
                                                <input type="checkbox" class="form-check-input me-2" checked onchange="this.form.submit()" name="completed" value="0">
                                                <label class="form-check-label">
                                                    {{ $task->task_name }}<br />
                                                    <small class="text-muted">{{ $task->deadline }}</small> -
                                                    <small class="text-muted">{{ $task->priority ? 'Priority' : 'Normal' }}</small>
                                                </label>
                                            </div>
                                        </form>

                                        <form id="delete-form-{{ $task->id }}" action="{{ route('task.destroy', $task->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button type="button" class="btn btn-sm btn-danger ms-2" onclick="confirmDelete({{ $task->id }})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="popupCard" tabindex="-1" aria-labelledby="popupCardLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content rounded">
                            <div class="modal-header">
                                <h5 class="modal-title text-dark" id="popupCardLabel">Add New Task</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('task.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="task-name" class="form-label fw-semibold">Task</label>
                                        <input type="text" class="form-control" id="task-name" name="task_name" placeholder="Enter Task" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="task-deadline" class="form-label fw-semibold">Deadline</label>
                                        <input type="date" class="form-control" id="task-deadline" name="deadline" required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Priority</label>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="priority" name="priority" value="1" required />
                                            <label for="priority" class="form-check-label">Priority</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="priority-no" name="priority" value="0" required />
                                            <label for="priority-no" class="form-check-label">No Priority</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Add Task</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content rounded">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Task</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editForm" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="mb-3">
                                        <label for="editTitle" class="form-label">Task Name</label>
                                        <input type="text" id="editTitle" name="task_name" class="form-control" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="editDeadline" class="form-label">Deadline</label>
                                        <input type="date" id="editDeadline" name="deadline" class="form-control" required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Priority</label>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="editPriority" name="priority" value="1" required />
                                            <label for="editPriority" class="form-check-label">Priority</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="editPriorityNo" name="priority" value="0" required />
                                            <label for="editPriorityNo" class="form-check-label">No Priority</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update Task</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function editTask(id, taskName, deadline, priority) {
            // Set form action
            var actionUrl = '{{ route("task.updateTask", ":id") }}';
            actionUrl = actionUrl.replace(':id', id);
            document.getElementById('editForm').action = actionUrl;

            // Set form values
            document.getElementById('editTitle').value = taskName;
            document.getElementById('editDeadline').value = deadline;
            document.getElementById('editPriority').checked = priority == 1;
            document.getElementById('editPriorityNo').checked = priority == 0;

            // Show modal
            var modal = new bootstrap.Modal(document.getElementById('editModal'));
            modal.show();
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin hapus task ini?',
                text: "Task akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('bahan/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>

