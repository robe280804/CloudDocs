<?php

namespace Tests\Unit;

class UserTest
{
    public function test_success_register_user()
    {
        $data = [
            'name' => 'Roberto',
            'email' => 'robesodo@gmail.com',
            'password' => bcrypt('robesodini*04')
        ];
    }
}
