<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class String_manipulation
{

  /**
   * spaceless_substr
   * exclude the white space in the string
   * @param $string - string to be limited
   * @param$start(int) - where the substr function to start
   * @param$count(int) - limit of characters
   * @return string
   *---------------------------------------------------
   * Anthony Canol - 06/19/2015
   */
	public function spaceless_substr($string, $start, $count)
	{
    return substr($string, $start, ($count+substr_count($string, ' ', $start, $count)));
	}
}