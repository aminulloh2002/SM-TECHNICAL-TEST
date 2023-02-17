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
        Schema::create('vehicle_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orderer_id')->constrained('users');
            $table->string('order_number')->unique();
            $table->integer('number_of_vehicle')->default(1);
            $table->foreignId('vehicle_id')->constrained();
            $table->foreignId('driver_id')->constrained();
            $table->foreignId('approver_id')->nullable()->constrained('users');
            $table->string('purpose');
            $table->string('travel_distance');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('approved_by_supervisor',['pending','approved','rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_orders');
    }
};
