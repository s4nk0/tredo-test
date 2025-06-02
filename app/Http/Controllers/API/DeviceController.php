<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{
    public function registerDevice(Request $request)
    {
        $request->validate([
            'device_id'=>'required|string|unique:user_devices,device_id',
            'user_id'=>'required|integer|exists:users,id',
        ]);

        User::find($request->user_id)?->devices()->create([
            'device_id'=>$request->device_id
        ]);

        return response()->json([
            'message'=>'Device registered successfully!'
        ]);
    }
}
