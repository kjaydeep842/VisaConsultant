<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('application_id')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('consultant_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->foreignId('visa_category_id')->nullable()->constrained('visa_categories')->nullOnDelete();
            $table->string('passport_number');
            $table->string('applicant_name');
            $table->date('dob')->nullable();
            $table->string('nationality')->nullable();
            $table->enum('status', ['draft', 'submitted', 'under_review', 'documents_required', 'processing', 'approved', 'rejected', 'on_hold', 'completed'])->default('draft');
            $table->string('current_stage')->nullable();
            $table->date('submission_date')->nullable();
            $table->date('expected_completion')->nullable();
            $table->date('visa_issued_date')->nullable();
            $table->date('visa_expiry_date')->nullable();
            $table->text('notes')->nullable();
            $table->decimal('total_fee', 10, 2)->default(0);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('application_timelines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained()->cascadeOnDelete();
            $table->string('stage');
            $table->text('description')->nullable();
            $table->string('performed_by')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('application_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('type');
            $table->string('file_path');
            $table->string('original_name');
            $table->bigInteger('file_size')->nullable();
            $table->enum('status', ['pending', 'submitted', 'approved', 'rejected'])->default('pending');
            $table->text('remarks')->nullable();
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('application_documents');
        Schema::dropIfExists('application_timelines');
        Schema::dropIfExists('applications');
    }
};
