<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Members;
use App\Services\MembersService;
use Exception;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    protected $membersService;
    public function __construct(MembersService $membersService)
    {
        $this->membersService = $membersService;
    }
    public function index()
    {
        $members = $this->membersService->getAll();
        if ($members->isEmpty()) {
            return response()->json([
                'message' => 'No members found'
            ], 404);
        }
        return response()->json($members, 200);
    }
    public function store(StoreMemberRequest $request)
    {
        try
        {
            $member = $this->membersService->createMember($request->validated());
            return response()->json([
                'status'  => true,
                'message' => 'Member created successfully',
                'data'    => $member
            ], 201);
        } catch (Exception $e) {
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
            $member = $this->membersService->getById($id);
            return response()->json([
                'status'  => true,
                'message' => 'Member found successfully',
                'data'    => $member
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
    public function update(UpdateMemberRequest $request, int $id)
    {
        try
        {
            $member = $this->membersService->updateMember($id, $request->validated());
            return response()->json([
                'status'  => true,
                'message' => 'Member updated successfully',
                'data'    => $member
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
            $this->membersService->deleteMember($id);
            return response()->json([
                'status'  => true,
                'message' => 'Member Delete successfully'
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
