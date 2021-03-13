<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * 脆弱なパスワードに変更
     *
     * @return UserFactory
     */
    public function vulnerablePass(): UserFactory
    {
        return $this->state([
            'password' => Hash::make('pass'),
        ]);
    }

    /**
     * テスト用email
     *
     * @return UserFactory
     */
    public function testEmail(): UserFactory
    {
        $path = dirname(__FILE__) . '/../../config/const/email.txt';
        if (file_exists($path)){

            $mail = explode("\n", file_get_contents($path))[0];

            if(!USER::where('email', '=', $mail)->exists()){
                return $this->state([
                    'email' => $mail,
                ]);
            }
        }
        return $this;
    }

    /**
     * テスト用email
     *
     * @return UserFactory
     */
    public function testUser(): UserFactory
    {
        return $this->state ([
            'name' => 'test',
            'email' => 'test@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('test'),
        ]);
    }
}
