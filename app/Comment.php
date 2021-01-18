<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 * @package App
 *
 * @param int $id
 * @param string $comment
 * @param bool $seen
 * @param Comment|null $parentId
 */
class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment', 'seen', 'parent_id'
    ];

    /**
     * Automatically set status planned for newly created Tasks
     */
    protected static function boot()
    {
        parent::boot();

        Comment::creating(function ($model) {
            $model->seen = false;
        });
    }

    public function task()
    {
        return $this->belongsTo('App\Task', 'task_id', 'id');
    }

    public function setSeen()
    {
        $this->seen = true;
    }

    public function parent()
    {
        return $this->belongsTo('App\Comment', 'parent_id');
    }

    public function child()
    {
        return $this->hasMany('App\Comment', 'parent_id', 'id');
    }

    public function scopeNotSeenComments($query)
    {
        return $query->where('seen', '=', 0)
            ->with('task:id,title');
    }
}
