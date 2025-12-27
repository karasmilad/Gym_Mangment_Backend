<?php

namespace App\Services;

use App\Enums\Gender;
use App\Models\Trainers;
use Exception;
class TrainersService
{
    public function get_all()
    {
        return Trainers::latest()->get();
    }
    public function createTrainer(array $validateData)
    {
        try
        {
            if(!in_array($validateData['gender'],['male','female']))
            {
                throw new Exception('Gender Value is Invalid');
            }
            $trainer = Trainers::create($validateData);
            return $trainer;
        }
        catch(Exception $e)
        {
            throw new Exception("Error creating Trainer: " . $e->getMessage());
        }
    }
    public function getById(int $id)
    {
        try
        {
            $trainer = Trainers::findOrFail($id);
            return $trainer;
        }
        catch(Exception $e)
        {
            throw new Exception("Error : ". $e->getMessage());
        }
    }
    public function deleteTrainer(int $id)
    {
        try
        {
            $trainer = Trainers::findOrFail($id);
            $trainer->delete();
        }
        catch(Exception $e)
        {
            throw new Exception("Error: ". $e->getMessage());
        }
    }
    public function updateTrainer(int $id, array $validateData)
    {
        try
        {
            $trainer = Trainers::findOrFail($id);
            if(isset($validateData['gender'])) 
            {
                $validateData['gender'] = Gender::from($validateData['gender'])->value;
            }
            $trainer->update($validateData);
            return $trainer->refresh();
        }
        catch(Exception $e)
        {
            throw new Exception("Error : ". $e->getMessage());
        }
    }
}