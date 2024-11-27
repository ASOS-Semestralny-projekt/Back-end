<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use HasFactory;

    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * Create a new category.
     *
     * @param array $array
     * @return Category|null
     */
    public static function create(array $array): ?Category
    {
        $category = new self();
        $category->fill($array);
        $category->save();

        return $category;
    }

    /**
     * Find a category by its ID.
     *
     * @param int $categoryId
     * @return Category|null
     */
    public static function find(int $categoryId): ?Category
    {
        return static::query()->find($categoryId);
    }

    public static function truncate()
    {
        return static::query()->delete();
    }
}
