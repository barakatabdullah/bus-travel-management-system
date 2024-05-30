<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $cashierRole = Role::create(['name' => 'cashier']);
        $passengerRole = Role::create(['name' => 'passenger']);
        $addUsersPermission = Permission::create(['name' => 'add users']);
        $managePermission = Permission::create(['name' => 'manage']);

        $adminRole->givePermissionTo($addUsersPermission);
        $adminRole->givePermissionTo($managePermission);
        $cashierRole->givePermissionTo($managePermission);

        $adminApiRole = Role::create(['guard_name' => 'api','name' => 'admin']);
        $cashierApiRole = Role::create(['guard_name' => 'api','name' => 'cashier']);
        $passengerApiRole = Role::create(['guard_name' => 'api','name' => 'passenger']);
        $addUsersApiPermission = Permission::create(['guard_name' => 'api','name' => 'add users']);
        $manageApiPermission = Permission::create(['guard_name' => 'api','name' => 'manage']);

        $adminApiRole->givePermissionTo($addUsersApiPermission);
        $adminApiRole->givePermissionTo($manageApiPermission);
        $cashierApiRole->givePermissionTo($manageApiPermission);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('initial_permissions');
    }
};
