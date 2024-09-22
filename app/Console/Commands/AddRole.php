<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Role;

class AddRole extends Command
{
    // The name and signature of the console command.
    protected $signature = 'role:add {name}';

    // The console command description.
    protected $description = 'Add a new role by its name';

    // Execute the console command.
    public function handle()
    {
        $roleName = $this->argument('name');

        // Check if the role already exists
        if (Role::where('name', $roleName)->exists()) {
            $this->error("The role '{$roleName}' already exists.");
            return 1; // Return a non-zero code to indicate error
        }

        // Create a new role
        $role = new Role();
        $role->name = $roleName;
        $role->save();

        $this->info("Role '{$roleName}' added successfully.");
        return 0; // Return zero to indicate success
    }
}
