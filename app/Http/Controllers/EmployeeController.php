<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    // Display list & form
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    // Store new employee (INSERT)
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|unique:employee,employee_id',
            'employee_name' => 'required',
            'employee_address' => 'required',
            'designation' => 'required',
            'date_of_joined' => 'required|date',
            'basic_salary' => 'required|numeric',
            'contact_number' => 'required',
            'department_id' => 'required',
            'contract_period_expire_date' => 'nullable|date',
        ]);

        $data = $request->all();
        if (empty($data['contract_period_expire_date'])) {
            $data['contract_period_expire_date'] = '2018-09-30';
        }

        Employee::create($data);

        return redirect()->back()->with('success', 'Employee added successfully!');
    }

    // Update existing employee (UPDATE)
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'employee_name' => 'required',
            'employee_address' => 'required',
            'designation' => 'required',
            'date_of_joined' => 'required|date',
            'basic_salary' => 'required|numeric',
            'contact_number' => 'required',
            'department_id' => 'required',
            'contract_period_expire_date' => 'required|date',
        ]);

        $employee->update($request->all());

        return redirect()->back()->with('success', 'Employee updated successfully!');
    }

    // Delete employee (DELETE)
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->back()->with('success', 'Employee deleted successfully!');
    }

    // Question 5: Calculate total basic salary paid until contract expire date
    public function calculateSalary($id)
    {
        $employee = Employee::findOrFail($id);

        $startDate = Carbon::parse('2018-01-01'); // Fixed date as per question constraint
        $endDate = Carbon::parse($employee->contract_period_expire_date);

        if ($startDate->greaterThan($endDate)) {
            return redirect()->back()->with('error', 'Start date is after contract expiry date!');
        }

        // Calculate full months difference
        $months = $startDate->diffInMonths($endDate);
        $totalSalaryPaid = $months * $employee->basic_salary;

        return redirect()->back()->with('salary_info', "Total Basic Salary paid from 2018-01-01 to {$employee->contract_period_expire_date} ({$months} months): Rs. " . number_format($totalSalaryPaid, 2));
    }
}