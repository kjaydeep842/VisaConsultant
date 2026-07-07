<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('code', 3)->nullable();
            $table->string('flag')->nullable();
            $table->string('banner')->nullable();
            $table->text('overview')->nullable();
            $table->text('benefits')->nullable();
            $table->text('eligibility')->nullable();
            $table->text('required_documents')->nullable();
            $table->string('processing_time')->nullable();
            $table->decimal('visa_cost', 10, 2)->nullable();
            $table->text('job_opportunities')->nullable();
            $table->text('universities')->nullable();
            $table->text('pr_pathway')->nullable();
            $table->text('faqs')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
