<?php

namespace Database\Factories;

use App\Models\post;
use Illuminate\Database\Eloquent\Factories\Factory;
use League\CommonMark\Node\Block\Paragraph;
//此針對models post資料表來做
class PostFactory extends Factory
{
    //protected $model =Post::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->word,
            'content' =>$this->faker->paragraph
        ];
    }
}
