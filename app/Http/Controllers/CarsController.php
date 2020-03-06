<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use \Validator;
use Symfony\Component\HttpFoundation\Response;

class CarsController extends AppController {
    
    private Cars $model;

    public function __construct(Cars $cars) {
        $this->model = $cars;
    }

    public function getAll(){
        try{
            $cars = $this->models->all();
            return response()->json($cars, Response::HTTP_OK);
        }catch(\Exception $e){
            return $this->handleException($e);
        }
    }

    public function get($id){
        try{
            $car = $this->model->find($id);
            if($car){
                return response()->json($car, Response::HTTP_OK);
            }else{
                return response()->json(null, Response::HTTP_OK);
            }
        }catch(\Exception $e){
            return $this->handleException($e);
        }
        
    }

    public function store(Request $request){

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required | max:80',
                'description' => 'required',
                'model' => 'required | max:10 | min:2',
                'date' => 'required | date_format: "Y-m-d'
            ]
        );

        if($validator->fails()){
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST); 
        }

        try{
            $car = $this->model->create($request->all());
            return response()->json($car, Response::HTTP_CREATED);
        }catch(\Exception $e){
            return $this->handleException($e);
        }
    }

    public function update($id, Request $request){

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required | max:80',
                'description' => 'required',
                'model' => 'required | max:10 | min:2',
                'date' => 'required | date_format: "Y-m-d'
            ]
        );

        if($validator->fails()){
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST); 
        }

        try{
            $car = $this->model->find($id);
            $car->update($request->all());
            return response()->json($car, Response::HTTP_OK);
        }catch(\Exception $e){
            return $this->handleException($e);
        }
    }

    public function destroy($id){
        try{
            $car = $this->model->find($id);
            $car->delete();
            return response()->json(null, Response::HTTP_OK); 
        }catch(\Exception $e){
            return $this->handleException($e);
        }
    }
}
