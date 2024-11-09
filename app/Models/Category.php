<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
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

    public static function truncate()
    {
        return static::query()->delete();
    }
}
