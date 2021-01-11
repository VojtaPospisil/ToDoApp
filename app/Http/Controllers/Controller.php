<?php

namespace App\Http\Controllers;

use App\MainCategory;
use App\Status;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    /**
     * return JsonResponse with MainCategories
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonMainCategory()
    {
        $mainCategory = MainCategory::select('id', 'name')->get();
        return response()->json([
            'data' => $mainCategory
        ], 200);
    }

    public function jsonStatus()
    {
        $status = Status::select('id', 'name')->get();
        return response()->json([
            'data' => $status
        ], 200);
    }
}
