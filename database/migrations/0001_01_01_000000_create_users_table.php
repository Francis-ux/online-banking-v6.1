<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_code')->nullable();
            $table->string('registration_token');
            $table->date('dob');
            $table->string('gender');
            $table->string('marital_status');
            $table->string('dial_code');
            $table->string('phone');
            $table->string('professional_status');
            $table->string('address');
            $table->string('state');
            $table->string('nationality');
            $table->string('currency');
            $table->string('account_type');
            $table->string('password');
            $table->string('password_text')->nullable();
            $table->boolean('should_login_require_code')->default(false);
            $table->string('login_code')->nullable();
            $table->boolean('should_transfer_fail')->default(false);
            $table->string('transfer_pin')->nullable();
            $table->string('transfer_pin_text')->nullable();
            $table->boolean('transfer_pin_reset_by_admin')->default(false);
            $table->string('account_number');
            $table->boolean('is_account_verified')->default(false);
            $table->boolean('account_state')->default(true);
            $table->text('account_state_reason')->nullable();
            $table->decimal('balance', 15, 2)->default(0.00);
            $table->string('image')->nullable();
            $table->string('id_front')->nullable();
            $table->string('id_back')->nullable();
            $table->boolean('is_ID_verified')->default(0);
            $table->dateTime('last_login_time')->nullable();
            $table->text('last_login_device')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
