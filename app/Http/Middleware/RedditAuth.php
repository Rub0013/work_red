<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedditAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $referrer = null;
        if(!empty($request->input('referrer')) && $request->input('referrer') == 'extension'){
            $referrer = $request->input('referrer');
        }

        $user = Auth::user()->toArray();
        if($user['reddit_id']){
//            return redirect()->route('schedules');
            return $next($request);
        }else{
            if(!empty($referrer)){
                return redirect()->route('redditLogin',['referrer' => $referrer]);
            }
            return redirect()->route('redditLogin');
        }
    }
}
