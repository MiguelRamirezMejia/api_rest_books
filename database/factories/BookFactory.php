<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'gender' => $this->faker->word,
            'synopsis' => $this->faker->paragraph,
            'any_publication' => $this->faker->year,
        ];
    }
}
