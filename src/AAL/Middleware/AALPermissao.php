<?php

namespace Manzoli2122\AAL\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class AALPermissao
{
	const DELIMITER = '|';
	protected $auth;
	
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	
	public function handle($request, Closure $next, $permissoes)
	{
		if (!is_array($permissoes)) {
			$permissoes = explode(self::DELIMITER, $permissoes);
		}
		if ($this->auth->guest() || !$request->user()->can($permissoes)) {
			abort(403);
		}
		return $next($request);
	}
}
