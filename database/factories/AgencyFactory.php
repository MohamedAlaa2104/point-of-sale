<?php

namespace Database\Factories;

use App\Models\Agency;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgencyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Agency::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_en'=>$this->faker->sentence(),
            'name_ar'=>$this->faker->sentence(),
            'small_description_en'=>$this->faker->text(200),
            'small_description_ar'=>$this->faker->text(200),
            'description_en'=>$this->faker->text(2000),
            'description_ar'=>$this->faker->text(2000),
            'slug'=>$this->faker->catchPhrase(),
        ];
    }
}
