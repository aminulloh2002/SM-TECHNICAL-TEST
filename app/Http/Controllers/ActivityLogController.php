<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ActivityLogController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->hasRole('admin')) {
                return $next($request);
            }
            abort(403, 'Unauthorized action.');
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        if(!Auth::user()->hasRole('admin')) {
            return abort(403);
        }
        $activityLogs = ActivityLog::with('user')->get();
        return view('activity-log.index',compact('activityLogs'));
    }
}
