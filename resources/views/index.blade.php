<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To do List</title>
    <link rel="stylesheet" href="{{ asset('bahan/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-14">
                <div class="card border-0 shadow-sm rounded" style="background-color: rgba(223, 233, 255, 0.8);">
                    <div class="card-body">
                        <h2>TODOWZT</h2>
                        <br>
                        <br>
                        <center>
                            <h3 style="font-weight: bold;">Your To Do List</h3>
                        </center>
                        <div class="container mt-4">
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <div class="card mt-4 border-0 shadow-sm rounded" style="background-color: #0623DB; color: white;">
                                            <div class="card-body">
                                                <h4>Do</h4>
                                                <!-- Inner Card (nested inside the outer card) -->
                                                <div class="card mt-3 border-0 shadow-sm rounded" style="background-color: #28a745; color: white;">
                                                    <div class="card-body">
                                                        <!-- Checkbox inside the card -->
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="task1">
                                                            <label class="form-check-label" for="task1" style="font-size: large">make Back-end tdl</label>
                                                            <label class="form-check-label" for="task1" style="font-size: small">Mark as complete</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#popupCard">
                                                    <i class="bi bi-plus-circle-fill"></i> Add New List
                                                </button>
                                                <!-- Modal (Popup Card) -->
                                                <div class="modal fade" id="popupCard" tabindex="-1" role="dialog" aria-labelledby="popupCardLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content rounded">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" style="color: black" id="popupCardLabel">Add New List</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <!-- Modal Body -->
                                                            <div class="modal-body">
                                                                <div class="card shadow-sm rounded">
                                                                    <div class="card-body">
                                                                        {{-- <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"> --}}
                                                                            @csrf

                                                                            <div class="form-group">
                                                                                <label class="font-weight-bold">Task</label>
                                                                                <input type="text" class="form-control @error('task') is-invalid @enderror" name="task" placeholder="Masukkan Task Anda">
                                                                                @error('task')
                                                                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="font-weight-bold">Deadline</label>
                                                                                <input type="Date" class="form-control @error('deadline') is-invalid @enderror" name="deadline" placeholder="Masukkan deadline Anda">
                                                                                @error('deadline')
                                                                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="font-weight-bold">Priority Set</label>
                                                                                <!-- Radio Buttons -->
                                                                                <div class="form-check">
                                                                                    <input type="radio" id="priority" name="priority" value="high" class="form-check-input">
                                                                                    <label for="priority" class="form-check-label @error('priority') is-invalid @enderror" name="priority">Priority</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input type="radio" id="no_priority" name="no_priority" value="no_priority" class="form-check-input">
                                                                                    <label for="no_priority" class="form-check-label">No Priority</label>
                                                                                </div>
                                                                                @error('priority')
                                                                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                            <!-- Modal Footer -->
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                                            </div>
                                                                        </form>
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

                                <!-- Second Card (Done Column) -->
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <div class="card mt-4 border-0 shadow-sm rounded" style="background-color: #0623DB; color: white;">
                                            <div class="card-body">
                                                <h4>Done</h4>
                                                <br>
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
    </div>
<!-- Link to Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>