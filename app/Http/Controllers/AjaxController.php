<?php

// namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Category;
use App\Models\Kind;
use Auth;

public function getCategory(Request $request) 
{
    $categories = Kind::query()
        ->find($request->kind_id)
        ->get();
    return $categories;
}
