<?php

namespace App\Services\AdminServices;

use App\Category;
use App\Http\Requests\CategoryRequest;

class CategoryService
{

    /**
     * @param CategoryRequest $request
     */
    public function updateOrCreateCategory(CategoryRequest $request)
    {
        Category::updateOrCreate(
            ['id' => $request->id], [
                'name' => $request->name,
                'description' => $request->description
            ]
        );
    }
}
