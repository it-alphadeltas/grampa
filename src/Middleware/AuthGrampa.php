<?php

namespace AlphaDeltas\Grampa\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthGrampa
{
    private $enabled;
    private $credentials;

    public function __construct()
    {
        $this->enabled      = config('grampa.protected');
        $this->credentials  = config('grampa.protection');
    }

    public function handle(Request $request, Closure $next)
    {
        if (!$this->enabled)
            return $next($request);

        if ($request->header('PHP_AUTH_USER', null) && $request->header('PHP_AUTH_PW', null)) {

            $username = $request->header('PHP_AUTH_USER');
            $password = $request->header('PHP_AUTH_PW');
            if ($username === $this->credentials['login'] && $password === $this->credentials['pass'])
                return $next($request);
        }

        return response()->make('Invalid credentials.', 401, ['WWW-Authenticate' => 'Basic']);
    }
}
