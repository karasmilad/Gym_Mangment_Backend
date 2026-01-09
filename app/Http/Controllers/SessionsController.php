<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrainingSessionRequest;
use App\Http\Requests\UpdateTrainingSessionRequest;
use App\Models\Sessions;
use App\Services\SessionsService;
use Exception;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
        protected SessionsService $sessionService;
        public function __construct(SessionsService $sessionService)
    {
        $this->sessionService = $sessionService;
    }
    public function index()
    {
        try
        {
            $session = $this->sessionService->get_all();
            if ($session->isEmpty()) {
                return response()->json([
                    'message' => 'No Sessions found'
                ], 404);
            }
            return response()->json($session, 200);
        }
        catch(Exception $e)
            {
                return response()->json([
                    'status'  => false,
                    'message' => $e->getMessage()
                ], 422);
            }
    }
    public function store(StoreTrainingSessionRequest $request)
    {
        try
            {
                $session = $this->sessionService->createSession($request->validated());
                return response()->json([
                    'status'  => true,
                    'message' => 'Session created successfully',
                    'data'    => $session
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
                $session = $this->sessionService->getById($id);
                return response()->json([
                    'status'  => true,
                    'message' => 'Session found successfully',
                    'data'    => $session
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
    public function update(UpdateTrainingSessionRequest $request, int $id)
    {
        try
            {
                $trainer = $this->sessionService->updateSession($id, $request->validated());
                return response()->json([
                    'status'  => true,
                    'message' => 'Session updated successfully',
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
            $this->sessionService->deleteSession($id);
            return response()->json([
                'status'  => true,
                'message' => 'Session Delete successfully'
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
