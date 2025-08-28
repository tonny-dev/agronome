<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChemicalSoilTestingTables extends Migration
{
    public function up()
    {
        // Soil samples table
        Schema::create('soil_samples', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_id')->constrained('farms')->onDelete('cascade');
            $table->foreignId('field_id')->nullable()->constrained('fields')->onDelete('set null');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('sample_code')->unique();
            $table->timestamp('collection_date');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->integer('depth_cm')->default(20);
            $table->text('weather_conditions')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->default('collected'); // collected, sent_to_lab, results_received
            $table->timestamps();
        });

        // Chemical test parameters
        Schema::create('chemical_test_parameters', function (Blueprint $table) {
            $table->id();
            $table->string('parameter_name');
            $table->string('parameter_code');
            $table->string('unit');
            $table->decimal('optimal_min', 8, 3)->nullable();
            $table->decimal('optimal_max', 8, 3)->nullable();
            $table->string('test_method')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Chemical test results
        Schema::create('soil_chemical_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sample_id')->constrained('soil_samples')->onDelete('cascade');
            $table->foreignId('parameter_id')->constrained('chemical_test_parameters')->onDelete('cascade');
            $table->decimal('result_value', 10, 4);
            $table->string('lab_reference')->nullable();
            $table->timestamp('test_date');
            $table->string('status')->default('pending'); // pending, completed, verified
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // Soil recommendations
        Schema::create('soil_recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sample_id')->constrained('soil_samples')->onDelete('cascade');
            $table->string('recommendation_type'); // fertilizer, lime, organic_matter
            $table->string('product_name');
            $table->decimal('quantity_per_hectare', 8, 2);
            $table->string('unit');
            $table->text('application_method')->nullable();
            $table->string('timing')->nullable(); // before_planting, during_growth, etc.
            $table->decimal('estimated_cost', 10, 2)->nullable();
            $table->timestamps();
        });

        // Soil health scores
        Schema::create('soil_health_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sample_id')->constrained('soil_samples')->onDelete('cascade');
            $table->decimal('overall_score', 5, 2); // 0-100
            $table->decimal('ph_score', 5, 2);
            $table->decimal('nutrient_score', 5, 2);
            $table->decimal('organic_matter_score', 5, 2);
            $table->text('interpretation');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('soil_health_scores');
        Schema::dropIfExists('soil_recommendations');
        Schema::dropIfExists('soil_chemical_results');
        Schema::dropIfExists('chemical_test_parameters');
        Schema::dropIfExists('soil_samples');
    }
}
