<?php

namespace App\Console\Commands;

use App\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin on Terminal!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data['name'] = $this->ask('Enter your name!');
        $data['email'] = $this->ask('Enter your email!');
        $data['password'] = $this->secret('Enter your password!');
        $data['password_confirmation'] = $this->secret('Confirm your password!');

        if ($data['password'] !== $data['password_confirmation']) {
            $this->error('Password incorrect! Please try again!');
        }

        Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $this->info('You have been successfully registered.');
    }
}
