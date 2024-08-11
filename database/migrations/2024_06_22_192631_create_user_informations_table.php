<?php

use App\Enums\CompanyType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('user_verification_request_id')->constrained('user_verification_requests')->cascadeOnDelete();
            $table->foreignId('statute_id');
            $table->foreignId('certificate_changes_id');
            $table->foreignId('official_newspaper_id');
            $table->foreignId('signature_certificate_id');
            $table->foreignId('official_letter_introduction_id');
            $table->foreignId('agent_national_card_id');
            $table->foreignId('agent_birth_certificate_id');
            $table->foreignId('ceo_national_card_id');
            $table->foreignId('added_value_certificate_id');
            $table->string('name');
            $table->tinyInteger('type')->default(CompanyType::LEGAL);
            $table->string('establishment_date');
            $table->text('address');
            $table->string('national_code');
            $table->string('postal_code');
            $table->string('phone');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_informations');
    }
};
