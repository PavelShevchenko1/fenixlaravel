<?php

namespace App\Http\Middleware;

use App\Models\FxAppUser;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppUserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Проверяем наличие заголовка Authorization
        $sessionId = $request->header('Authorization');

        // Если заголовок отсутствует или пуст
        if (!$sessionId) {
            return response()->json(['error' => 'Unauthorized. Session ID is required.'], 401);
        }

        // Ищем сессию по session_id в БД
        $session = FxAppUser::where('session_id', $sessionId)->first();

        // Если сессия не найдена
        if (!$session) {
            return response()->json(['error' => 'Unauthorized. Invalid session ID.'], 401);
        }

        // Сохраняем объект сессии в текущем запросе
        $request->attributes->set('session', $session);

        return $next($request);
    }
}
