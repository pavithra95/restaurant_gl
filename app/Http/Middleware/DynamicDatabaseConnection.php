<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class DynamicDatabaseConnection
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            $userDatabaseName = 'kggl_' . $user->name;
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }

        return $next($request);
    }
}
