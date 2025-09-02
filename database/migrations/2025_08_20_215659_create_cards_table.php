<?php

use App\Models\User;
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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->text('card_number'); // Encrypted
            $table->string('expiry_date', 5); // MM/YY
            $table->string('cvv', 255); // Encrypted
            $table->enum('type', ['virtual', 'physical'])->default('virtual');
            $table->enum('status', ['pending', 'active', 'inactive', 'blocked'])->default('pending');
            $table->string('reference_id');
            $table->decimal('daily_limit', 15, 2)->nullable(); // Optional spending limit
            $table->decimal('issuance_fee', 15, 2)->default(0.00); // Fee for card issuance
            $table->timestamp('issued_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
