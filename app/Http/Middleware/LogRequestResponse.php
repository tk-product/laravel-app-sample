<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class LogRequestResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $sessionId = $request->session()->getId() ?? Str::uuid();

        // リクエストログ出力
        Log::info('LogRequestResponse middleware called.');
        $this->log('info', 'REQUEST_HEADER', $sessionId, $request->headers->all());
        $this->log('info', 'REQUEST_BODY', $sessionId, $request->all());

        $response = $next($request);

        // レスポンスログ出力
        $this->log('info', 'HTTP_STATUS', $sessionId, ['status' => $response->getStatusCode()]);
        $this->log('info', 'RESPONSE_HEADER', $sessionId, $response->headers->all());

        $content = $response->getContent();
        $decoded = json_decode($content, true);
        $responseBody = $decoded ?? $content;

        $this->log('info', 'RESPONSE_BODY', $sessionId, $responseBody);

        return $response;
    }

    private function log(string $level, string $label, string $sessionId, $data): void
    {
        $timestamp = now()->format('Y/m/d H:i:s.v');
        $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        Log::{$level}("{$timestamp} [{$level}] SESIONID=[\"{$sessionId}\"] {$label}=[{$json}]");
    }
}
