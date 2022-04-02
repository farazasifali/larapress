<?php

namespace farazasifali\Larapress\Models;

use farazasifali\Larapress\Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Disable Laravel mass assignment protection
    protected $guarded = [];

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected function newFactory()
    {
        return PostFactory::new();
    }


}
