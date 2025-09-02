<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->boolean('can_request_reservation')->default(true);
            $table->boolean('can_access_dashboard')->default(false);
            $table->boolean('can_manage_user')->default(false);
            $table->boolean('can_manage_reservation')->default(false);
            $table->boolean('can_manage_role')->default(false);
            $table->boolean('can_manage_notification')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('role_permissions');
    }
};
