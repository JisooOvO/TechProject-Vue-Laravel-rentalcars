<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Inertia\Inertia;


class BrandController extends Controller
{
    public function store()
    {
        $brands = Brand::all();
        return response() -> json($brands);
    }
}
