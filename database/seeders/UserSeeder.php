<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $data = [
        [
            'email' => 'astratyandmitry@gmail.com',
            'password' => 'aveego',
        ],
    ];

    /**
     * @return void
     */
    public function run(): void
    {
        foreach ($this->data as $data) {
            $data['password'] = bcrypt($data['password']);
            $data['email_verified_at'] = now();

            User::query()->create($data);
        }
    }
}
