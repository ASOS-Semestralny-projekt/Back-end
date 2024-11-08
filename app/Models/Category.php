<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
    ];

    public static function create(array $array): Category
    {
        $category = new self();
        $category->fill($array);
        $category->save();
        return $category;
    }

    public static function find($categoryId)
    {
        return static::query()->find($categoryId);
    }
}
