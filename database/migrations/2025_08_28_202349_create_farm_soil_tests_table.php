<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmSoilTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farm_soil_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('farm_id')->constrained('farms')->onDelete('cascade');
            $table->foreignId('field_id')->nullable()->constrained('fields')->onDelete('set null');
            $table->unsignedBigInteger('test_id');
            $table->json('results')->nullable();
            $table->text('recommendations')->nullable();
            $table->integer('percent_completed')->default(0);
            $table->timestamp('test_date')->nullable();
            $table->timestamps();
            
            // Add indexes for performance
            $table->index(['farmer_id', 'farm_id']);
            $table->index(['farm_id', 'test_id']);
            $table->index(['test_date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farm_soil_tests');
    }
}