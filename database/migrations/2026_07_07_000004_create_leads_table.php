<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('country_interested')->nullable();
            $table->string('visa_type')->nullable();
            $table->integer('age')->nullable();
            $table->string('education')->nullable();
            $table->integer('experience_years')->nullable();
            $table->decimal('english_score', 4, 1)->nullable();
            $table->string('occupation')->nullable();
            $table->decimal('budget', 12, 2)->nullable();
            $table->integer('family_members')->nullable();
            $table->text('message')->nullable();
            $table->string('source')->default('website'); // website, whatsapp, facebook, instagram, google, landing_page
            $table->enum('status', ['new', 'contacted', 'qualified', 'converted', 'lost'])->default('new');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('follow_up_at')->nullable();
            $table->text('notes')->nullable();
            $table->integer('eligibility_score')->nullable();
            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
