<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('booking_ref')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('lead_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('consultant_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->string('branch')->nullable();
            $table->enum('meeting_type', ['offline', 'online_meet', 'zoom', 'whatsapp'])->default('offline');
            $table->string('meeting_link')->nullable();
            $table->string('purpose')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed', 'no_show'])->default('pending');
            $table->text('notes')->nullable();
            $table->boolean('reminder_sent')->default(false);
            $table->decimal('fee', 10, 2)->default(0);
            $table->enum('payment_status', ['unpaid', 'paid', 'refunded'])->default('unpaid');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
