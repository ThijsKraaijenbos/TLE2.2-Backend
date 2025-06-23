<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class ValidateUserLoginToken
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    //random comment because for some dumbass reason this didn't get pushed :(
    public function handle(Request $request, Closure $next): Response
    {
        $userToken = $request->header('X-user-login-token');
        if (!$userToken) {
            return response()->json(["error" => "Please provide an X-user-login-token header"], 400);
        }

        $token = PersonalAccessToken::findToken($userToken);
        if (!$token || $token->tokenable_type !== User::class) {
            return response()->json(["error" => "This user token is invalid"], 401);
        }

        $request->merge(["token" => $token]);
        return $next($request);
    }
}
