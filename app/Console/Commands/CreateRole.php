<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class CreateRole extends Command
{
    protected $signature = 'role:create {name}';
    protected $description = 'Create a new role';

    public function handle()
    {
        $roleName = $this->argument('name');

        if (Role::where('name', $roleName)->exists()) {
            $this->error("Role already exists!");
            return 1;
        }

        Role::create(['name' => $roleName]);
        $this->info("Role '{$roleName}' created successfully.");
    }
}
