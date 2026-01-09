<?php

namespace App\Services;

use App\Models\TrainingSession;
use Exception;
class SessionsService
{
    public function get_all()
    {
        try {
            return TrainingSession::with(['trainer', 'category', 'bookings'])
                ->latest()
                ->get();
        } 
        catch (Exception $e) {
            throw new Exception('Failed to fetch training sessions :' . $e->getMessage());
        }
    }
    public function getById(int $id)
    {
        try {
            return TrainingSession::with(['trainer', 'category', 'bookings'])
                ->findOrFail($id);
        } 
        catch (Exception $e) {
            throw new Exception('Training session not found : ' . $e->getMessage());
        }
    }
    public function createSession(array $data)
    {
        try {
            return TrainingSession::create($data);
        } catch (Exception $e) {
            throw new Exception('Failed to create training session : ' . $e->getMessage());
        }
    }
    public function updateSession(int $id , array $data)
    {
        try 
        {
            $session = TrainingSession::findOrFail($id);
            $session->update($data);
            return TrainingSession::with(['trainer', 'category', 'bookings'])->findOrFail($id);
        } catch (Exception $e) {
            throw new Exception('Failed to update training session : ' . $e->getMessage());
        }
    } 
    public function deleteSession(int $id)
    {
        try {
            $session = TrainingSession::findOrFail($id);
            return $session->delete();
        } catch (Exception $e) {
            throw new Exception('Failed to delete training session : ' . $e->getMessage());
        }
    }

}