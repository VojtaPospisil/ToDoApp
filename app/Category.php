<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 *  * Class Category
 * @package App
 *
 * @property string $name
 * @property string $description
 */
class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public function category()
    {
        return $this->belongsToMany(
            Task::class,
            'category_task',
            'category_id',
            'task_id'
        );
    }

    public static function getCategoryFormData()
    {
        return Category::all(['id', 'name']);
    }

    public function getTest()
    {
        return true;
    }
}
