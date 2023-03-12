<?php

namespace App\Console\Commands\User;

use Database\Seeders\Estore\Catalog\RolePermissionsSeeder;
use Illuminate\Console\Command;

class PublishRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'estore:set-roles-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create permissions and roles for users';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        (new RolePermissionsSeeder())->run();
    }
}
