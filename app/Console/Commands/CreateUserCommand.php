<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {--name= : Name of person.} {--email= : E-Mail of the newly created user.} {--phone= : Phone user.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manually creates a new laravel user.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->option('name');
        if ($name === null) {
            $name = $this->ask('Please enter your name.');
        }

        $email = $this->option('email');
        if ($email === null) {
            $email = $this->ask('Please enter your e-mail.');
        }

        $phone = $this->option('phone');
        if ($phone === null) {
            $phone = $this->ask('Please enter your phone.');
        }

        $password = $this->secret('Please enter a new password.');

        $input = [
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'phone' => $phone,
        ];

        try {
            $new_user_action = new User();
            $user = $new_user_action->create($input);
        }
        catch (\Exception $e) {
            $this->error($e->getMessage());
            return;
        }

        // Success message
        $this->info('User created successfully!');
        $this->info('New user id: ' . $user->id);
    }
}
