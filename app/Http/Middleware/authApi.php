<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\RedditHelper;
use App\User;

class authApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userId = $request->input('user_id');
        $user = User::where(['reddit_id' => $userId])->first();
        $access_token = $request->input('access_token');
        if ($user && $access_token == $user->access_token) {
            $redditHelper = new RedditHelper();
            $newAccessToken =  $redditHelper->refreshToken($user->refresh_token)->access_token;
            $user->access_token = $newAccessToken;
            $user->save();
            return $next($request)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        } else {
            return response()->json([
                "data" => $user->access_token,
                "error" => true,
                "status" => "Forbidden",
                "message" => "The access token not provided",
            ], 403);
        }
    }
}
