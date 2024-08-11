<?php

use App\Enums\VerificationStatuses;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_verification_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_verification_request_id')->constrained('user_verification_requests')->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->json('details')->nullable();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->tinyInteger('status')->default(VerificationStatuses::REQUESTED);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_verification_events');
    }
};
