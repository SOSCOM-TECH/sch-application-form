<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;

class MigrateRoles extends Command
{
    protected $signature = 'app:migrate-roles';
    protected $description = 'Migrate legacy roles (client/school_owner) to school_representative';

    public function handle(): int
    {
        $targetRole = Role::firstOrCreate(['name' => 'school_representative']);

        $affected = 0;
        User::with('roles')->chunk(100, function ($users) use (&$affected, $targetRole) {
            foreach ($users as $user) {
                if ($user->hasRole('client') || $user->hasRole('school_owner')) {
                    $user->syncRoles(array_unique(
                        collect($user->roles->pluck('name')->all())
                            ->map(function ($name) {
                                return in_array($name, ['client', 'school_owner']) ? 'school_representative' : $name;
                            })
                            ->all()
                    ));
                    $affected++;
                }
            }
        });

        $this->info("Migrated roles for {$affected} users to 'school_representative'.");
        return Command::SUCCESS;
    }
}


