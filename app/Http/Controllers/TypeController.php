<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use Inertia\Inertia;


class TypeController extends Controller
{
    public function store()
    {
        $types = Type::all();
        return response() -> json($types);
    }
}
