<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
class CheckAdmin
{
    // tao auth

    protected $auth;

    // ham khoi tao, chay contruc dau tien

    public function __construct(Guard $auth)
    {
        $this->auth=$auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // neu co van de j loc ra k phai admin

        if(!$this->auth->user()->isAdmin())
        {
           // muon mang thong bao dung session()->flash('key', 'noidung')
            return redirect('/login');
        }

        return $next($request);
    }
}
