<?php

namespace App\Http\Controllers\Api;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function getSubCategoryByCategory($parent_id)
    {
        $categories = Category::where('parent_id', $parent_id)->where('status', 'Y')->get();
        if ($categories === null) {
            $categories = [];
        }
        $data = [
            'categories' => $categories
        ];
        return $data;
    }
}
