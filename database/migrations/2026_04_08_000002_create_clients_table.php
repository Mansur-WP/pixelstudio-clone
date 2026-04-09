<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('phone')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('deposit', 10, 2)->nullable();
            $table->enum('photo_format', ['Softcopy', 'Hardcopy', 'Both']);
            $table->integer('quantity')->default(1);
            $table->enum('order_status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->enum('payment_status', ['unpaid', 'partial', 'paid'])->default('unpaid');
            $table->string('gallery_token', 40)->nullable();
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('studio_id');
            $table->unsignedBigInteger('created_by_id');
            $table->foreign('studio_id')->references('id')->on('studios')->onDelete('cascade');
            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('clients');
    }
};
