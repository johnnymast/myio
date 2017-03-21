<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class SecureAdmin
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // If the auth user is null, redirect to home page
        if (is_null($this->auth->user())) {
            return redirect()->route('homepage');
        }

        // Allow access only to administrators
        if (!$this->auth->user()->hasRole('Administrator')) {
            abort(404, 'You are not authorized to view requested resource.');

            return redirect()->route('homepage');
        }

        return $next($request);
    }
}
