<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->decimal('amount', 10, 2);
            $table->string('description')->nullable();
            $table->string('status')->default('unpaid');
            $table->date('due_date')->nullable();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('studio_id');
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('studio_id')->references('id')->on('studios')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('invoices');
    }
};
