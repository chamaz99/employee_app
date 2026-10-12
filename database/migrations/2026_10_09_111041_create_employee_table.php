<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->string('employee_id')->primary(); 
            $table->string('employee_name');
            $table->text('employee_address');
            $table->string('designation');
            $table->date('date_of_joined'); 
            $table->decimal('basic_salary', 10, 2); 
            $table->string('contact_number');
            $table->string('department_id')->index(); 
            $table->date('contract_period_expire_date')->default('2018-09-30'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};