<?php

namespace App\Repository\Admin;

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
