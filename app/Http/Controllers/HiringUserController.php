<?php

namespace App\Http\Controllers;

use App\Models\HiringUser;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

class HiringUserController extends BaseController
{
    public function index()
    {
        $hiringUsers = HiringUser::all();
        return $this->sendResponse($hiringUsers, 'Hiring users retrieved successfully.');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:hiring_users,email',
                'notes' => 'nullable|string',
                'phone' => 'nullable|string|max:20|unique:hiring_users,phone',
            ]);
        } catch (ValidationException $e) {
            return $this->sendError('Please check your details and try again.', $e->errors(), 422);
        }

        try {
            $hiringUser = HiringUser::create($validated);
            return $this->sendResponse($hiringUser, 'Thanks! Your message has been sent successfully.', 201);
        } catch (QueryException $e) {
            // Catches things like duplicate phone/email that slipped past validation
            return $this->sendError('This email or phone number has already been submitted.', [], 409);
        } catch (\Exception $e) {
            // Catches anything else unexpected — never expose raw DB errors
            return $this->sendError('Something went wrong on our end. Please try again shortly.', [], 500);
        }
    }
}