<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // passengers
            'create_reservation',
            'cancel_reservation',
            'view_trip_history',
            'filter_drivers_by_location',
            'filter_drivers_by_availability',
            'modify_reservation',
            // driver
            'accept_reservation',
            'reject_reservation',
            'update_availability',
            'view_trip_history_driver',
            'mark_trip_completed',
            'cancel_trip',
            'set_trip_price',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $passengerRole = Role::firstOrCreate(['name' => 'passenger']);
        $driverRole = Role::firstOrCreate(['name' => 'driver']);

        $passengerRole->givePermissionTo([
            'create_reservation',
            'cancel_reservation',
            'view_trip_history',
            'filter_drivers_by_location',
            'filter_drivers_by_availability',
            'modify_reservation'
        ]);

        $driverRole->givePermissionTo([
            'accept_reservation',
            'reject_reservation',
            'update_availability',
            'view_trip_history_driver',
            'mark_trip_completed',
            'cancel_trip',
            'set_trip_price'
        ]);
    }
}
