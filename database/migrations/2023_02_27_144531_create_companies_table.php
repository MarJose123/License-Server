<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('website')->nullable();
            $table->string('industry')->nullable();
            $table->foreignId('company_primary_contact')->nullable();
            $table->integer('employee_size')->nullable();
            $table->foreignId('created_by');
            $table->foreignId('updated_by');
            $table->foreignId('deleted_by');
            $table->foreignId('forced_deleted_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
