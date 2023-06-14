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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignIdFor(
                \App\Models\listing::class,
                'listing_id'
            )->constrained('listings');

            $table->foreignIdFor(
                \App\Models\User::class,
                'bidder_id'
            )->constrained('users');

            $table->unsignedInteger('amount');

            //tu peux aussi mettre en Boolean mais une date est mieux 
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
