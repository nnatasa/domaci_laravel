<?php

namespace Database\Factories;

use Carbon\Carbon;

use App\Models\User;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::all()->pluck('id')->toArray();
        $authors = Author::all()->pluck('id')->toArray();

        return [
            'author_id' => $this->faker->randomElement($authors),
            'title' => $this->faker->company,
            'description' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id' => $this->faker->randomElement($users)
        ];
    }
}
