<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'/libraries/hashids'.EXT;

class hs Extends hashids\Hashids
{
	public function __construct()
	{
		//parent::__construct(md5(date('mm').'azP3nQz00o010'),8);
		parent::__construct(md5('azP3nQz00o010'),8);
	}
}