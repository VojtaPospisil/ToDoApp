<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MainCategory
 * @package App
 *
 * @property int $id
 * @property string $name
 */
class MainCategory extends Model
{
    const NICETOHAVE = 1;
    const MUSTHAVE = 2;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public static function getMainCategoryFormData()
    {
        return MainCategory::all(['id', 'name']);
    }
}
