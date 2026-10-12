<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee';
    protected $primaryKey = 'employee_id';
    public $incrementing = false; 
    protected $keyType = 'string';

    protected $fillable = [
        'employee_id',
        'employee_name',
        'employee_address',
        'designation',
        'date_of_joined',
        'basic_salary',
        'contact_number',
        'department_id',
        'contract_period_expire_date'
    ];
}