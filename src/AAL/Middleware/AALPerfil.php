<?php 

namespace Manzoli2122\AAL\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class AALPerfil
{
	const DELIMITER = '|';
	protected $auth;
	
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}
	
	public function handle($request, Closure $next, $perfis)
	{
		if (!is_array($perfis)) {
			$perfis = explode(self::DELIMITER, $perfis);
		}
		if ($this->auth->guest() || !$request->user()->hasPerfil($perfis)) {
			abort(403);
		}
		return $next($request);
	}
}
