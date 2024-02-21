<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Inertia\Inertia;


class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return Inertia::render('cars/index', compact('cars'));
    }

    public function create()
    {
        return Inertia::render('cars/create');
    }

    public function store(Request $request)
    {
        $car = Car::create($request->all());

        return response() -> json($car);
    }

    public function show(Car $car)
    {
        $reservations = $car->reservations;

        return view('cars.show', compact('car', 'reservations'));
    }
}
