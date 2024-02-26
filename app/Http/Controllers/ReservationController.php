<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Car;
use Inertia\Inertia;
use App\Events\ReservationUpdated;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function update()
    {
        DB::beginTransaction();
        
        try{
            $today = Carbon::now() -> setTimezone('Asia/Seoul') -> toDateTimeString();
            
            $usedReservations = Reservation::where('start_at', '<=' ,$today) 
                -> where('reservation_status', 'reserved')
                -> get();
            
            foreach ($usedReservations as $usedReservation) {
                $car_id = $usedReservation -> car_id;
                $car = Car::find($car_id);
                event(new ReservationUpdated($car -> id));
            }

            Reservation::where('start_at', '<=' ,$today) -> update(["reservation_status" => "used"]);

            Reservation::where('end_at', '<' ,$today) -> update(["reservation_status" => "overdue"]);

            DB::commit();

            return response() -> json(["status" => "ok"]);

        } catch(\Exception $e){
            DB::rollback();

            return response()->json(["status" => "fail", "error" => $e->getMessage()]); 
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $id = $request -> input('car_id');
            
            $car = Car::findOrFail($id);
            
            if($car -> available_quantity <= 0 ){
                return response() -> json(["status" => "not_available"]);
            }
            
            $data = $request -> all();

            Reservation::create($data);
            
            DB::commit();

            return response() -> json(["status" => "ok"]);

        } catch(\Exception $e){

            DB::rollback();

            return response()->json(["status" => "fail", "error" => $e->getMessage()]); 
        } 
    }
}
