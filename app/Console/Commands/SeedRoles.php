<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class SeedRoles extends Command
{
    protected $signature = 'app:seed-roles';
    protected $description = 'Создать роли: admin, advertiser, webmaster';

    public function handle()
    {
        $roles = ['admin', 'advertiser', 'webmaster'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
            $this->info("Роль '$role' создана (если не существовала).");
        }

        $this->info('Все роли успешно добавлены.');
    }
}