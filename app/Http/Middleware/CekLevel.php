<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$levels)
    {

        if (in_array($request->user()->jabatan,$levels)) {
            return $next($request);
        } 
        elseif ($request->user()->jabatan == 'Direktur Operasional' || $request->user()->jabatan == 'SDM' || $request->user()->jabatan == 'TSI'|| $request->user()->jabatan == 'Pembukuan') {
            return $next($request);

        } elseif ($request->user()->level == 'MEDIUM USER') {
            $request->query->add(['id_cabang' => $request->user()->id_cabang]);
            $request->query->add(['nama' => $request->user()->nama]);
            return $next($request);
        }

       return redirect('/home');


    }
}
