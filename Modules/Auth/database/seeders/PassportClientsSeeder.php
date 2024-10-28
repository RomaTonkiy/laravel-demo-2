<?php

namespace Modules\Auth\database\seeders;

use Illuminate\Database\Seeder;
use Laravel\Passport\Client;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;
use Modules\Users\Models\Admin;
use Modules\Users\Models\Organization;
use Modules\Users\Models\Teacher;
use Modules\Users\Models\User;
use Modules\Users\Models\UserParent;

class PassportClientsSeeder extends Seeder
{
    public function __construct(
        private ClientRepository $clientRepository
    )
    {
    }

    public function run(): void
    {
        $this->createClientForProvider(Admin::class, Admin::TABLE);
        $this->createClientForProvider(Organization::class, Organization::TABLE);
        $this->createClientForProvider(Teacher::class, Teacher::TABLE);
        $this->createClientForProvider(User::class, User::TABLE);
        $this->createClientForProvider(UserParent::class, UserParent::TABLE);
    }

    private function createClientForProvider(string $name, string $provider): void
    {
        $exists = Client::query()
            ->where('provider', $provider)
            ->where('name', $name)
            ->exists();

        if ($exists) {
            $this->command->info("Password grant client for {$name} already exists.");

            return;
        }

        $client = $this->clientRepository->createPasswordGrantClient(
            null, $name, 'http://localhost', $provider
        );

        $this->command->info("Password grant client for {$name} created successfully.");

        $this->outputClientDetails($client);
    }

    private function outputClientDetails(Client $client): void
    {
        if (Passport::$hashesClientSecrets) {
            $this->command->line('<comment>Here is your new client secret. This is the only time it will be shown so don\'t lose it!</comment>');
            $this->command->line('');
        }

        $this->command->line('<comment>Client ID:</comment> ' . $client->getKey());
        $this->command->line('<comment>Client secret:</comment> ' . $client->plainSecret);
    }
}
