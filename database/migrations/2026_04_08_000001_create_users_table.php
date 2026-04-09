<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('studio_id')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'staff', 'platform']);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('studio_id')->references('id')->on('studios')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('users');
    }
};
