<?php


namespace Database\Seeders;


use App\Enums\BotStatus;
use App\Enums\RoleConst;
use App\Models\Bot;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        /** @var User $me */
        $me = User::query()->create([
            'name' => 'Davut Sergeev',
            'email' => 'sergeevdavut@mail.ru',
            'bot_limit' => 7,
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        // Bots

        Bot::query()->create([
            'local_name' => 'TestBot',
            'api_key' => Str::random(),
            'config' => [],
            'status' => BotStatus::STATUS_PENDING,
            'user_id' => $me->id,
            'link' => 'https://t.me/testbot'
        ]);

        Bot::query()->create([
            'local_name' => 'Test2Bot',
            'api_key' => Str::random(),
            'config' => [],
            'status' => BotStatus::STATUS_PENDING,
            'user_id' => $me->id,
            'link' => 'https://t.me/test2bot'
        ]);

        Bot::query()->create([
            'local_name' => 'Test3Bot',
            'api_key' => Str::random(),
            'config' => [],
            'status' => BotStatus::STATUS_PENDING,
            'user_id' => $me->id,
            'link' => 'https://t.me/test3bot'
        ]);

        $me->assignRole(Role::findByName(RoleConst::ROLE_SUPER_ADMIN));
    }
}
