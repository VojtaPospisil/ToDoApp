<?php

namespace App\Repository\Admin;

use App\Task;
use Illuminate\Support\Facades\DB;

class TaskRepository
{
    public function filterDate($query, $dateSearch)
    {
        $comparsion = isset($dateSearch['dueDateFrom']) ? '>=' : '<=';

        if (count($dateSearch) == 1) {
            return $query->where('due_date', $comparsion, reset($dateSearch));
        }

        return $query->whereBetween('due_date', [$dateSearch['dueDateFrom'], $dateSearch['dueDateTo']]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getTaskQueryWithRelationships()
    {
        return Task::with('category:id,name')->select(
            'tasks.id',
            'tasks.title',
            'tasks.description',
            'tasks.due_date',
            'u.id as user_assigned_id',
            'u.name as user_assigned_name',
            'uc.id as user_created_id',
            'uc.name as user_created_name',
            's.id as status_id',
            's.name as status_name',
            'mc.id as main_category_id',
            'mc.name as main_category_name'
        )->join('users as u', 'tasks.user_id', '=', 'u.id')
        ->join('users as uc', 'tasks.user_created', '=', 'uc.id')
        ->join('statuses as s', 'tasks.status_id', '=', 's.id')
        ->join('main_categories as mc', 'tasks.main_category_id', '=', 'mc.id')
        ->orderBy('tasks.id');
    }

    public function getStatus($query)
    {
        return $query->select(['id', 'name']);
    }

    public function getUserCreated($query)
    {
        return $query->select('id', 'name');
    }

    public function getUserAssigned($query)
    {
        return $query->select('id', 'name');
    }

    public function getUserCategory($query)
    {
        return $query->select('id', 'name');
    }
}
