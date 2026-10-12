<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">Employee Management System</h2>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('salary_info'))
        <div class="alert alert-info fw-bold">{{ session('salary_info') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Employee Input Form -->
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Add New Employee</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('employees.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Employee ID</label>
                        <input type="text" name="employee_id" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Employee Name</label>
                        <input type="text" name="employee_name" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Designation</label>
                        <input type="text" name="designation" class="form-control" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Employee Address</label>
                        <textarea name="employee_address" class="form-control" rows="2" required></textarea>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Date of Joined</label>
                        <input type="date" name="date_of_joined" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Basic Salary</label>
                        <input type="number" step="0.01" name="basic_salary" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Contact Number</label>
                        <input type="text" name="contact_number" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Department ID</label>
                        <input type="text" name="department_id" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contract Period Expire Date</label>
                        <input type="date" name="contract_period_expire_date" value="2018-09-30" class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3">Add Employee</button>
            </form>
        </div>
    </div>

    <!-- Employee Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Employee List</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Joined Date</th>
                        <th>Basic Salary</th>
                        <th>Dept ID</th>
                        <th>Expire Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $emp)
                    <tr>
                        <td>{{ $emp->employee_id }}</td>
                        <td>{{ $emp->employee_name }}</td>
                        <td>{{ $emp->designation }}</td>
                        <td>{{ $emp->date_of_joined }}</td>
                        <td>{{ number_format($emp->basic_salary, 2) }}</td>
                        <td>{{ $emp->department_id }}</td>
                        <td>{{ $emp->contract_period_expire_date }}</td>
                        <td>
                            <!-- Calculate Salary Button (Question 5) -->
                            <a href="{{ route('employees.calculate', $emp->employee_id) }}" class="btn btn-sm btn-info text-white">Calc Total Salary</a>

                            <!-- Delete Button -->
                            <form action="{{ route('employees.destroy', $emp->employee_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete employee?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- jQuery (as requested in requirement 4) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>