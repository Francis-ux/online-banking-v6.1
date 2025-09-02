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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->decimal('amount', 15, 2); // Principal
            $table->decimal('interest_rate', 5, 2); // e.g., 5.00%
            $table->integer('duration_months');
            $table->decimal('total_repayable', 15, 2); // Principal + Interest
            $table->text('purpose')->nullable();
            $table->enum('status', ['pending', 'approved', 'active', 'repaid', 'rejected'])->default('pending');
            $table->string('reference_id');
            $table->timestamp('disbursed_at')->nullable();
            $table->timestamp('due_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
