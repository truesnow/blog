<?php

namespace App\Http\Middleware;

use Closure;
use Ramsey\Uuid\Uuid;
use Auth;
use Route;
use App\Models\VisitLog as VisitLogModel;
use Illuminate\Support\Facades\Log;

class VisitLog
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
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $except_paths = config('visit-log.except.paths');
        $except_prefixs = config('visit-log.except.prefixs');
        $requestPath = $request->path();
        if (in_array($requestPath, $except_paths)) {
            return false;
        }
        for ($i = 0; $i < count($except_prefixs); $i++) {
            if (starts_with($requestPath, $except_prefixs[$i])) {
                return false;
            }
        }
        // 用户访问记录
        $uuid = Uuid::uuid1();
        $path = explode('/', $request->path());
        $now = date('Y-m-d H:i:s', time());
        $data = [
            'log_id' => $uuid->getHex(),
            'user_id' => empty(Auth::id()) ? 0 : Auth::id(),
            'user_model' => \App\Models\User::class,
            'url' => $request->path(),
            'subject_id' => empty($path[1]) ? 0 : $path[1],
            'subject_model' => empty($path[0]) ? '' : $path[0],
            'ip' => ip2long($request->ip()),
            'user_agent' => $request->userAgent(),
            'method' => $request->method(),
            'query_string' => http_build_query($request->query()),
            'form_data' => $request->post() == [] ? '' : json_encode($request->post()),
            'description' => Route::currentRouteName(),
            'created_at' => $now,
            'updated_at' => $now,
        ];

        VisitLogModel::insert($data);
    }
}
