<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Car;
use App\Models\Reservation;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;


class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with(['brand', 'fuel', 'type']) ->get();
        return Inertia::render('cars/index', compact('cars'));
    }

    public function create()
    {
        return Inertia::render('cars/create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $modelName = $request -> input('model_name');
            
            $car = Car::where("model_name", $modelName) -> firstOrFail();
            
            if(!empty($car->image_path)){
                $filePath = 'public' . $car->image_path;
                Storage::delete($filePath);
            }
            $newCar = Car::updateOrCreate(['model_name' => $request->model_name], $request->all());

            $availableQuantity = Car::where(['model_name' => $request->model_name]) -> value('available_quantity');
            $totalQuantity = Car::where(['model_name' => $request->model_name]) -> value('total_quantity');
            $requestTotalQuantity = $request -> total_quantity;

            $totalAvailableQuantity = $requestTotalQuantity + $availableQuantity;
            
            Car::where(['model_name' => $request->model_name]) -> update(['available_quantity' => $totalAvailableQuantity]);
            Car::where(['model_name' => $request->model_name]) -> update(['total_quantity' => $totalQuantity + $requestTotalQuantity]);

            DB::commit();

            return response()->json(["status" => "ok"]);
        } catch(\Exception $e){
            DB::rollback();
            return response()->json(["status" => "fail to update / create car information", "error" => $e->getMessage()]); 
        }
    }

    public function upload(Request $request)
    {
        try {

            $base64Image = $request -> input('img');
            
            $imageData = base64_decode($base64Image);
            
            $path = 'public/images';
            
            $filename = 'uploaded_image_' . now()->format('YmdHis') . '.png';
            
            $storedPath = Storage::put($path . '/' . $filename, $imageData);
            
            return response() -> json(['image_path' => $filename]);
        } catch(\Exception $e){
            return response()->json(["status" => "fail", "error" => $e->getMessage()]); 
        }
    }

    public function showAll()
    {
        $cars = Car::with(['brand', 'fuel', 'type', 'reservation']) ->get();
        return response() -> json($cars);
    }

    public function show($id)
    {
        $car = Car::with(['brand', 'fuel', 'type','reservation']) -> find($id);

        if($car == null) {
            return Inertia::render('errors/notFound');
        }

        if($car -> available_quantity <= 0 ){
            return Inertia::render('errors/notAvailable');
        }

        return Inertia::render('cars/show', ['car' => $car]);
    }

    public function reservation(Request $request)
    {
        $id = $request -> query('id');
        $car = Car::with(['brand', 'fuel', 'type','reservation']) -> find($id);

        if($car == null) {
            return Inertia::render('errors/notFound');
        }

        if($car -> available_quantity <= 0 ){
            return Inertia::render('errors/notAvailable');
        }

        return Inertia::render('cars/reservation', ['car' => $car]);
    }
}   
