<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckReturnDate
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {

    if (strtotime( $request->returndate1) < strtotime( $request->departdate1)) {
      // die("<script> alert('ok') </script> ");
      return response("<script> alert('回程日期不得早於出發日期喔') </script> ");
    }

    return $next($request);
  }
}
