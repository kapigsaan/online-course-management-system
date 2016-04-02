<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('style_url'))
{
	function style_url($uri = '')
	{
		$CI =& get_instance();
		return $CI->config->base_url('assets/css/'.$uri.'.css');
	}
}

if ( ! function_exists('script_url'))
{
	function script_url($uri = '')
	{
		$CI =& get_instance();
		return $CI->config->base_url('assets/js/'.$uri.'.js');
	}
}

if ( ! function_exists('image_url'))
{
	function image_url($image_name = '')
	{
		$CI =& get_instance();
		return $CI->config->base_url('assets/images/'.$image_name);
	}
}


if ( ! function_exists('img_url'))
{
	function img_url($img_name = '')
	{
		$CI =& get_instance();
		return $CI->config->base_url('assets/img/'.$img_name);
	}
}

if ( ! function_exists('banner_url'))
{
	function banner_url($image_name = '')
	{
		$CI =& get_instance();
		return $CI->config->base_url('assets/images/banner/'.$image_name);
	}
}

if ( ! function_exists('assets_url'))
{
	function assets_url($ass_name = '')
	{
		$CI =& get_instance();
		return $CI->config->base_url('assets/'.$ass_name);
	}
}