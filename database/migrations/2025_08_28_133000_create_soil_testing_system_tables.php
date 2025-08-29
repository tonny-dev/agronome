<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoilTestingSystemTables extends Migration
{
    public function up()
    {
        // Update farms table
        Schema::table('farms', function (Blueprint $table) {
            $table->string('location_admin_code')->nullable()->after('name');
            $table->string('location_name')->nullable()->after('location_admin_code');
            $table->decimal('centroid_lat', 10, 8)->nullable()->after('location_name');
            $table->decimal('centroid_lng', 11, 8)->nullable()->after('centroid_lat');
            $table->decimal('size_hectares', 8, 2)->nullable()->after('centroid_lng');
            $table->json('details_json')->nullable()->after('size_hectares');
        });

        // Vendors table
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location_admin_code');
            $table->string('location_name');
            $table->decimal('lat', 10, 8);
            $table->decimal('lng', 11, 8);
            $table->string('contact');
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['lat', 'lng']);
        });

        // Kits table
        Schema::create('kits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['available', 'held', 'checked_out', 'diagnostics', 'unavailable'])->default('available');
            $table->string('serial_no')->unique();
            $table->timestamp('last_diagnostics_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['vendor_id', 'status']);
        });

        // Inventory ledgers table
        Schema::create('inventory_ledgers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kit_id')->constrained()->onDelete('cascade');
            $table->enum('event', ['hold', 'release', 'checkout', 'return', 'diagnostics_pass', 'diagnostics_fail']);
            $table->string('ref_type');
            $table->unsignedBigInteger('ref_id');
            $table->json('metadata')->nullable();
            $table->timestamps();
            
            $table->index(['kit_id', 'event']);
            $table->index(['ref_type', 'ref_id']);
        });

        // Soil tests table
        Schema::create('soil_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('farm_id')->constrained()->onDelete('cascade');
            $table->foreignId('vendor_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('kit_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('type', ['chemical'])->default('chemical');
            $table->enum('status', [
                'draft', 'booked', 'paid', 'picked_up', 'testing', 
                'awaiting_return', 'returned', 'analysis_locked', 'analysis_unlocked', 'cancelled'
            ])->default('draft');
            $table->timestamp('pickup_at')->nullable();
            $table->timestamp('testing_at')->nullable();
            $table->timestamp('dropoff_at')->nullable();
            $table->boolean('allow_extra_day')->default(false);
            $table->decimal('total_price', 10, 2)->nullable();
            $table->enum('payment_status', ['pending', 'initiated', 'confirmed', 'failed', 'refunded'])->default('pending');
            $table->string('payment_ref')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['user_id', 'status']);
            $table->index(['farm_id', 'status']);
        });

        // Sampling plans table
        Schema::create('sampling_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('soil_test_id')->constrained()->onDelete('cascade');
            $table->integer('sample_count');
            $table->json('plan_json');
            $table->timestamps();
        });

        // Sample locations table
        Schema::create('sample_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('soil_test_id')->constrained()->onDelete('cascade');
            $table->integer('seq_no');
            $table->decimal('lat', 10, 8);
            $table->decimal('lng', 11, 8);
            $table->decimal('elevation_m', 8, 2)->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
            $table->timestamps();
            
            $table->unique(['soil_test_id', 'seq_no']);
        });

        // Depth results table
        Schema::create('depth_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sample_location_id')->constrained()->onDelete('cascade');
            $table->enum('depth_type', ['surface', 'sub_surface_30cm']);
            $table->json('ambient_json');
            $table->json('soil_json');
            $table->timestamp('device_ts');
            $table->enum('sms_dispatch_status', ['queued', 'sent', 'failed'])->default('queued');
            $table->timestamps();
        });

        // Payments table
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('soil_test_id')->constrained()->onDelete('cascade');
            $table->enum('gateway', ['mpesa', 'airtel']);
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('KES');
            $table->enum('status', ['initiated', 'prompt_sent', 'confirmed', 'failed', 'refunded'])->default('initiated');
            $table->string('external_ref')->nullable();
            $table->json('payload_json')->nullable();
            $table->timestamps();
        });

        // Returns table
        Schema::create('returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('soil_test_id')->constrained()->onDelete('cascade');
            $table->boolean('vendor_checked')->default(false);
            $table->text('vendor_notes')->nullable();
            $table->enum('diagnostics_result', ['pass', 'fail'])->nullable();
            $table->boolean('user_confirmed')->default(false);
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamps();
        });

        // Results raw aggregates table
        Schema::create('results_raw_aggregates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('soil_test_id')->constrained()->onDelete('cascade');
            $table->json('aggregate_json');
            $table->boolean('locked_until_return')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('results_raw_aggregates');
        Schema::dropIfExists('returns');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('depth_results');
        Schema::dropIfExists('sample_locations');
        Schema::dropIfExists('sampling_plans');
        Schema::dropIfExists('soil_tests');
        Schema::dropIfExists('inventory_ledgers');
        Schema::dropIfExists('kits');
        Schema::dropIfExists('vendors');
        
        Schema::table('farms', function (Blueprint $table) {
            $table->dropColumn(['location_admin_code', 'location_name', 'centroid_lat', 'centroid_lng', 'size_hectares', 'details_json']);
        });
    }
}
