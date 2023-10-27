<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition()
    {
        return [
            'status' => $this->faker->boolean(),
            'view_count' => $this->faker->numberBetween(0, 100),
            'en' => [  // İngilizce dil çevirileri
                'title' => $this->faker->sentence(2),
                'description' => $this->faker->text(5),
            ],
            'fr' => [  // Fransızca dil çevirileri
                'title' => $this->faker->sentence(2),
                'description' => $this->faker->text(5),
            ],
            'az' => [  // Azerice dil çevirileri
                'title' => $this->faker->sentence(2),
                'description' => $this->faker->text(5),
            ],
            'ru' => [  // Rusça dil çevirileri
                'title' => $this->faker->sentence(2),
                'description' => $this->faker->text(5),
            ],
        ];
    }
}
