<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAuditController extends Controller
{
    public function index()
    {
        $trail = DB::table('system_audit_trail')
            ->join('users', 'system_audit_trail.user_id', '=', 'users.id')
            ->orderBy('system_audit_trail.created_at', 'DESC')
            ->select('*', 'system_audit_trail.created_at as created_at')
            ->simplePaginate(8);
        return view ('adminaudittrail')->with('trail', $trail);
    }
}
