<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CommonController extends Controller
{
    public function uploads(Request $request)
    {
        $path = $request->file('image')->store('public');
        return $path;
    }
}
