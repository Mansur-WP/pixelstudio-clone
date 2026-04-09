<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        // All columns already exist in the clients table. No action needed.
        // This migration is now a no-op.
    }
    public function down() {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn(['photo_format', 'quantity', 'price', 'deposit', 'order_status', 'payment_status']);
        });
    }
};
