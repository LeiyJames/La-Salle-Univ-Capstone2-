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
        Schema::create('events', function (Blueprint $table) {
            $table->id('events_id');
            $table->string('events_name');
            $table->date('events_start_date');
            $table->date('events_end_date');
            $table->text('events_location');
            $table->text('events_description');
            $table->string('events_organization_type')->nullable();
            $table->text('events_related_tags')->nullable();
            $table->boolean('events_workshop_registration')->nullable();
            $table->text('events_registration_link')->nullable();
            $table->json('events_properties')->nullable();
            $table->boolean('events_status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
