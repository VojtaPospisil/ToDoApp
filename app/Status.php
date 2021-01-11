<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Status Annotation
 * @package App
 *
 * @property int $id
 * @property string $name
 */
class Status extends Model
{
    protected $table = 'statuses';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    const PLANNED = 1;
    const INPROGRES = 2;
    const FINISHED = 3;
    const UNFINISHED = 4;

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
