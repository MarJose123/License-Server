<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable();
            $table->foreignId('customer_id')->nullable();
            $table->string('domain', 200)->nullable()->unique();
            $table->uuid('license_key')->unique();
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->dateTime('expiration_date')->nullable();
            $table->boolean('is_trial')->default(false);
            $table->boolean('is_lifetime')->default(false);
            $table->foreignId('created_by');
            $table->foreignId('updated_by');
            $table->foreignId('deleted_by');
            $table->foreignId('forced_deleted_by');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};
