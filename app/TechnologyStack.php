<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechnologyStack extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }

    public function candidate()
    {
        return $this->belongsToMany(Candidate::class);
    }
}
