<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

/**
 * Class Task
 * @package App
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property Category $category
 * @property MainCategory $mainCategory
 * @property Status $status
 * @property Date $due_date
 * @property User $userAssigned
 * @property Date $created_at
 * @property User $userCreated
 */
class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'category',
        'main_category_id',
        'status_id',
        'due_date',
        'user_id',
        'created_at',
        'user_created'
    ];

    /**
     * Automatically set status planned for newly created Tasks
     */
    protected static function boot()
    {
        parent::boot();

        Task::creating(function ($model) {
            $status = Status::find(Status::PLANNED);
            $model->status()->associate($status);
        });
    }

    public function userCreated()
    {
        return $this->belongsTo('App\User', 'user_created', 'id');
    }

    public function userAssigned()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function mainCategory()
    {
        return $this->belongsTo('App\MainCategory');
    }

    public function status()
    {
        return $this->belongsTo('App\Status', 'status_id', 'id');
    }

    public function category()
    {
        return $this->belongsToMany(
            Category::class,
            'category_task',
            'task_id',
            'category_id'
        );
    }

    public function comment()
    {
        return $this->hasMany('App\Comment')
            ->where('parent_id', '=', null)
            ->with('child');
    }

    public function scopeUnfinished($query)
    {
        return $query->where('status_id', '=', Status::UNFINISHED)->get();
    }

    public function scopePlanned($query)
    {
        return $query->where('status_id', '=', Status::PLANNED);
    }

    public function scopeToday($query)
    {
        return $query->where('due_date', '=', Carbon::today()->toDateString())->get();
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public function setStatus(int $id)
    {
        $status = Status::find($id);
        $this->status()->associate($status)->save();
    }
}
