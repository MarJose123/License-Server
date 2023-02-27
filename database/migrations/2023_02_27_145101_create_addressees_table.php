<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('addressees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company')->nullable();
            $table->foreignId('contact')->nullable();
            $table->string('street',60)->nullable();
            $table->string('city',60)->nullable();
            $table->string('state',60)->nullable();
            $table->string('post_code',10)->nullable();
            $table->boolean('is_billing')->default(false);
            $table->boolean('is_shipping')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addressees');
    }
};
