<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enums\UserRole;
use Symfony\Component\HttpFoundation\Response;


class EnsureUserHasRole
{
   public function handle(Request $request, Closure $next, string $role): Response
{
    $user = $request->user();

    if (! $user) {
        abort(403, 'Anda belum login.');
    }

    // Convert string $role ke enum UserRole
    $requiredRole = UserRole::from($role);

    // Bandingkan enum dengan enum
    if ($user->role !== $requiredRole) {
        abort(403, 'Anda tidak memiliki hak akses.');
    }

    return $next($request);
}
}