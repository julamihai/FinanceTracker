<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ExpensesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'amount'=> (float)random_int(100,9999) ,
            'category_id' => fake()->randomElement(Category::where('user_id',1)->where('type',Category::TYPE_EXPENSE)->get()->pluck('id')),
            'user_id' =>  1,
        ];
    }
}
