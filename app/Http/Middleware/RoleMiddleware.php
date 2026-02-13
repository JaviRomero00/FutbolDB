<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = $request->user();
        $message = 'No posees los requisitos necesarios para implementar cambios.';

        if (!$user || $user->role !== $role) {
            $previousUrl = url()->previous();
            $currentUrl = $request->fullUrl();

            if ($previousUrl && $previousUrl !== $currentUrl) {
                return redirect()->to($previousUrl)->with('error', $message);
            }

            abort(403, $message);
        }

        return $next($request);
    }
}
