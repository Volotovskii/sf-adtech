<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class MigrateUserRoles extends Command
{
    protected $signature = 'migrate:user-roles';
    protected $description = 'Assign roles from users.role column to spatie permissions system';

    public function handle()
    {
        $this->info('Starting role migration...');

        // Получаем всех пользователей
        $users = User::all();
        $processed = 0;
        $skippedNoRole = 0;
        $skippedInvalidRole = 0;
        $errors = 0;

        foreach ($users as $user) {
            $roleNameFromColumn = $user->role; // Читаем роль из столбца

            if (!$roleNameFromColumn) {
                $this->warn("User ID {$user->id} has no role in 'role' column, skipping.");
                $skippedNoRole++;
                continue; // Переходим к следующему
            }

            // Проверяем, существует ли роль в системе spatie
            $spatieRole = Role::where('name', $roleNameFromColumn)->first();

            if (!$spatieRole) {
                $this->error("Role '{$roleNameFromColumn}' does not exist in spatie roles table for user ID {$user->id}, skipping.");
                $skippedInvalidRole++;
                continue; // Переходим к следующему пользователю
            }

            try {

                $user->syncRoles([$spatieRole->name]); 
               
                $processed++;
                $this->info("Assigned role '{$roleNameFromColumn}' to user ID {$user->id}.");

            } catch (\Exception $e) {
                $this->error("Failed to assign role '{$roleNameFromColumn}' to user ID {$user->id}. Error: " . $e->getMessage());
                $errors++;
                Log::error("MigrateUserRoles Error for user {$user->id}: ", ['error' => $e->getMessage()]);
            }
        }

        $this->info("\nMigration finished.");
        $this->info("Processed: {$processed}");
        $this->info("Skipped (no role in column): {$skippedNoRole}");
        $this->info("Skipped (invalid role name): {$skippedInvalidRole}");
        $this->info("Errors: {$errors}");
    }
}