<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieResource;
use App\Models\Actor;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MovieRecommenderController extends Controller
{

    public function index(){
        $movies = Movie::with('actor')->get();
        return  MovieResource::collection($movies);
    }

    public function create(Request $request){
        try {
            $data = $request->all();

            $rules=[
                'title'=> 'required',
                'release_year'=>'required|digits:4|integer|min:1900',
                'director_name'=>'required|min:2',
                'actor_name'=>'required|min:2',
            ];

            $validation = validator::make($data, $rules);

            if ($validation->fails()) {
                return response()->json(['error' => $validation->errors()->first()], 403);
            }

            DB::beginTransaction();
            $actor_fullname = explode(" ", $request->actor_name);
            $firstName = $actor_fullname[0];
            $lastName = $actor_fullname[1] ?? null;

            $actor = Actor::create([
                'first_name'=>$firstName,
                'last_name'=>$lastName,
            ]);
            Movie::create([
                'title'=> $request->title,
                'release_year'=>$request->release_year,
                'director_name'=>$request->director_name,
                'actor_id'=>$actor->id
            ]);

            DB::commit();
            return response()->json(['Success' => "Movie added Successfully"], 200);
        } catch (\Exception $error) {
            info($error);
            DB::rollBack();
            return response()->json(['error' => "Something went wrong.Try again later"], 500);
        }
    }
}
