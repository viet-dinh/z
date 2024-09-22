<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Role;

class AssignUserRole extends Command
{
    // The name and signature of the console command.
    protected $signature = 'user:assign-role {email} {role}';

    // The console command description.
    protected $description = 'Assign a role to a user by email and role name';

    // Execute the console command.
    public function handle()
    {
        $email = $this->argument('email');
        $roleName = $this->argument('role');

        // Fetch the user by email
        $user = User::where('email', $email)->first();

        // If user doesn't exist, show an error
        if (!$user) {
            $this->error("User with email '{$email}' not found.");
            return 1; // Return non-zero code to indicate error
        }

        // Fetch the role by name
        $role = Role::where('name', $roleName)->first();

        // If role doesn't exist, show an error
        if (!$role) {
            $this->error("Role '{$roleName}' not found.");
            return 1; // Return non-zero code to indicate error
        }

        // Assign the role to the user
        if (!$user->roles()->where('role_id', $role->id)->exists()) {
            $user->roles()->attach($role->id);
            $this->info("Role '{$roleName}' assigned to user '{$email}'.");
        } else {
            $this->info("User '{$email}' already has the '{$roleName}' role.");
        }

        return 0; // Return zero to indicate success
    }
}
