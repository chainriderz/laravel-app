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
        Schema::create('new_properties', function (Blueprint $table) {
            $table->id(); // auto increment primary key

            $table->string('project_name');
            $table->string('sector_no', 50);
            $table->string('landmark', 150);
            $table->string('bhk', 200);
            $table->string('amount', 200);
            $table->string('builder_name')->nullable();
            $table->string('rera_number')->nullable();
            $table->date('launch_date')->nullable();
            $table->date('possession_date')->nullable();
            $table->enum('status', ['upcoming', 'under_construction', 'ready'])->default('upcoming');

            $table->foreignId('property_type_id')
                  ->constrained('property_types')
                  ->cascadeOnDelete();

            $table->foreignId('property_sub_type_id')
                  ->constrained('property_sub_types')
                  ->cascadeOnDelete();

            $table->foreignId('area_id')
                  ->constrained('areas')
                  ->cascadeOnDelete();

            $table->foreignId('city_id')
                  ->constrained('cities')
                  ->cascadeOnDelete();

            $table->enum('showtohome', ['0', '1'])->default('0');

            $table->string('description')->nullable();

            // property status
            $table->boolean('is_active')->default(true);

            // expiry date
            $table->date('active_till');

            // Optional timestamps (recommended)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_properties');
    }
};
