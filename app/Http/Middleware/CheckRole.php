<?php

namespace App\Http\Middleware;

use App\Session;
use Closure;
use App\User;
use App\Boolean;

class CheckRole
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
        // if action is accessable for all ???
        if($request->actionName != 'none') {
            $Userid = Session::getUserIdBySession($request->sessionkey);
            $loggedIn = Session::isLoggedIn($request->sessionkey);
            $user = User::where('id', $Userid)->first();
            // if user exist ???

            if ($user != null) {
                // if user logged in
                if($user['verified']==1) {
                    if(!$user['blocked']==1) {
                        if ($loggedIn==1) {
                            // if user have privilage to do that ???
                            if ($user->hasRole($request->roleName)) {
                                return $next($request);
                            } else {
                                return response('user is not have permission!', 399)->header('Content-Type', 'json');
                            }
                        }else{
                            return response('user is not logged in!', 400)->header('Content-Type', 'json');
                        }
                    }else{
                        return response('user is blocked!', 400)->header('Content-Type', 'json');
                    }
                }else{
                    return response('user is not verifiyed!', 400)->header('Content-Type', 'json');
                }
            }else{
                return response('user is not exist!', 400)->header('Content-Type', 'json');
            }
        }else{
            return $next($request);
        }
    }
}
