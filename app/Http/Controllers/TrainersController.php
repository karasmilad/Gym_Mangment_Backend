<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreTrainerRequest;
use App\Http\Requests\UpdateTrainerRequest;
use Exception;
use App\Services\TrainersService;
class TrainersController extends Controller
{
    protected $trainersService;
    public function __construct(TrainersService $trainersService)
    {
        $this->trainersService = $trainersService;
    }
    public function index()
    {
        $trainers = $this->trainersService->get_all();
        if ($trainers->isEmpty()) {
            return response()->json([
                'message' => 'No Trainers found'
            ], 404);
        }
        return response()->json($trainers, 200);
    }
    public function store(StoreTrainerRequest $request)
    {
        try
            {
                $trainer = $this->trainersService->createTrainer($request->validated());
                return response()->json([
                    'status'  => true,
                    'message' => 'Trainer created successfully',
                    'data'    => $trainer
                ], 201);
            } 
        catch (Exception $e) 
            {
                return response()->json([
                    'status'  => false,
                    'message' => $e->getMessage()
                ], 422);
            }
    }
    public function show(int $id)
    {
        try
            {
                $trainer = $this->trainersService->getById($id);
                return response()->json([
                    'status'  => true,
                    'message' => 'Trainer found successfully',
                    'data'    => $trainer
                ], 200);
            }
        catch (Exception $e)
        {
            return response()->json([
                'status'=> false,
                'message'=> $e->getMessage()
                ], 404);
        }
    }
    public function update(UpdateTrainerRequest $request, int $id)
    {
        try
            {
                $trainer = $this->trainersService->updateTrainer($id, $request->validated());
                return response()->json([
                    'status'  => true,
                    'message' => 'Trainer updated successfully',
                    'data'    => $trainer
                ], 200);
            } 
        catch (Exception $e) {
                return response()->json([
                    'status'  => false,
                    'message' => $e->getMessage()
                ], 422);
            }
    }
    public function destroy(int $id)
    {
    try
        {
            $this->trainersService->deleteTrainer($id);
            return response()->json([
                'status'  => true,
                'message' => 'Trainer Delete successfully'
            ], 200);
        }
        catch (Exception $e)
        {
            return response()->json([
                'status'=> false,
                'message'=> $e->getMessage()
                ], 404);
        }
    }
}
