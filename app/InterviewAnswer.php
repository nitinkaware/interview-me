<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InterviewAnswer extends Model
{
    protected $guarded = [];

    public function rate(int $rating)
    {
        $this->rating  = $rating;
        $this->save();
    }

    public function answer(string $answer)
    {
        $this->answer  = $answer;
        $this->save();
    }
}
