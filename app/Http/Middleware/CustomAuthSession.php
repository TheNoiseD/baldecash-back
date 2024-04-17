<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Laravel\Sanctum\Http\Middleware\AuthenticateSession;
use Symfony\Component\HttpFoundation\Response;
use function Pest\Laravel\json;

class CustomAuthSession extends AuthenticateSession
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            return parent::handle($request, $next);
        }catch (AuthenticationException $e) {
            return response()->json([
                'message' => 'Unauthenticated.'
            ], 401);
        }
    }
}
