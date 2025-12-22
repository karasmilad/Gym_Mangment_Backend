<?php
namespace App\Services;

use App\Enums\Gender;
use App\Models\Members;
use Exception;
use Illuminate\Support\Facades\Storage;

class MembersService
{
    public function getAll()
    {
        return Members::latest()->get();
    }
    public function createMember(array $validateData)
    {
        try
        {
            if(!in_array($validateData['gender'],['male','female']))
            {
                throw new Exception('Gender Value is Invalid');
            }
            if(isset($validateData['photo'])) 
            {
                $imageName = time() . '_' . $validateData['photo']->getClientOriginalName();
                Storage::disk('public')->putFileAs('memberImages', $validateData['photo'], $imageName);
                $validateData['photo'] = $imageName;
            } 
            else 
            {
                $validateData['photo'] = null;
            }
            $member = Members::create($validateData);
            return $member;
        }
        catch(Exception $e)
        {
            throw new Exception("Error creating member: " . $e->getMessage());
        }
    }
    public function getById(int $id)
    {
        try
        {
            $member = Members::findOrFail($id);
            return $member;
        }
        catch(Exception $e)
        {
            throw new Exception("Error : ". $e->getMessage());
        }
    }
    public function deleteMember(int $id)
    {
        try
        {
            $member = Members::findOrFail($id);
            $member->delete();
        }
        catch(Exception $e)
        {
            throw new Exception("Error: ". $e->getMessage());
        }
    }
    public function updateMember(int $id, array $validateData)
    {
        try
        {
            $member = Members::findOrFail($id);
            if(isset($validateData["photo"]))
            {
                if ($member->photo && Storage::disk('public')->exists('memberImages/' . $member->photo)) 
                {
                    Storage::disk('public')->delete('memberImages/' . $member->photo);
                }
                $imageName = time() . '_' . $validateData['photo']->getClientOriginalName();
                Storage::disk('public')->putFileAs('memberImages', $validateData['photo'], $imageName);
                $validateData['photo'] = $imageName;
            }   
            else 
            {
                unset($validateData['photo']);
            }
            if(isset($validateData['gender'])) 
            {
                $validateData['gender'] = Gender::from($validateData['gender'])->value;
            }
            $member->update($validateData);
            return $member->refresh();
        }
        catch(Exception $e)
        {
            throw new Exception("Error : ". $e->getMessage());
        }
    }
}