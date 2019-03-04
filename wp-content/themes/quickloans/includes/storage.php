<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('quickloans_storage_get')) {
	function quickloans_storage_get($var_name, $default='') {
		global $QUICKLOANS_STORAGE;
		return isset($QUICKLOANS_STORAGE[$var_name]) ? $QUICKLOANS_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('quickloans_storage_set')) {
	function quickloans_storage_set($var_name, $value) {
		global $QUICKLOANS_STORAGE;
		$QUICKLOANS_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('quickloans_storage_empty')) {
	function quickloans_storage_empty($var_name, $key='', $key2='') {
		global $QUICKLOANS_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($QUICKLOANS_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($QUICKLOANS_STORAGE[$var_name][$key]);
		else
			return empty($QUICKLOANS_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('quickloans_storage_isset')) {
	function quickloans_storage_isset($var_name, $key='', $key2='') {
		global $QUICKLOANS_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($QUICKLOANS_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($QUICKLOANS_STORAGE[$var_name][$key]);
		else
			return isset($QUICKLOANS_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('quickloans_storage_inc')) {
	function quickloans_storage_inc($var_name, $value=1) {
		global $QUICKLOANS_STORAGE;
		if (empty($QUICKLOANS_STORAGE[$var_name])) $QUICKLOANS_STORAGE[$var_name] = 0;
		$QUICKLOANS_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('quickloans_storage_concat')) {
	function quickloans_storage_concat($var_name, $value) {
		global $QUICKLOANS_STORAGE;
		if (empty($QUICKLOANS_STORAGE[$var_name])) $QUICKLOANS_STORAGE[$var_name] = '';
		$QUICKLOANS_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('quickloans_storage_get_array')) {
	function quickloans_storage_get_array($var_name, $key, $key2='', $default='') {
		global $QUICKLOANS_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($QUICKLOANS_STORAGE[$var_name][$key]) ? $QUICKLOANS_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($QUICKLOANS_STORAGE[$var_name][$key][$key2]) ? $QUICKLOANS_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('quickloans_storage_set_array')) {
	function quickloans_storage_set_array($var_name, $key, $value) {
		global $QUICKLOANS_STORAGE;
		if (!isset($QUICKLOANS_STORAGE[$var_name])) $QUICKLOANS_STORAGE[$var_name] = array();
		if ($key==='')
			$QUICKLOANS_STORAGE[$var_name][] = $value;
		else
			$QUICKLOANS_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('quickloans_storage_set_array2')) {
	function quickloans_storage_set_array2($var_name, $key, $key2, $value) {
		global $QUICKLOANS_STORAGE;
		if (!isset($QUICKLOANS_STORAGE[$var_name])) $QUICKLOANS_STORAGE[$var_name] = array();
		if (!isset($QUICKLOANS_STORAGE[$var_name][$key])) $QUICKLOANS_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$QUICKLOANS_STORAGE[$var_name][$key][] = $value;
		else
			$QUICKLOANS_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('quickloans_storage_merge_array')) {
	function quickloans_storage_merge_array($var_name, $key, $value) {
		global $QUICKLOANS_STORAGE;
		if (!isset($QUICKLOANS_STORAGE[$var_name])) $QUICKLOANS_STORAGE[$var_name] = array();
		if ($key==='')
			$QUICKLOANS_STORAGE[$var_name] = array_merge($QUICKLOANS_STORAGE[$var_name], $value);
		else
			$QUICKLOANS_STORAGE[$var_name][$key] = array_merge($QUICKLOANS_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('quickloans_storage_set_array_after')) {
	function quickloans_storage_set_array_after($var_name, $after, $key, $value='') {
		global $QUICKLOANS_STORAGE;
		if (!isset($QUICKLOANS_STORAGE[$var_name])) $QUICKLOANS_STORAGE[$var_name] = array();
		if (is_array($key))
			quickloans_array_insert_after($QUICKLOANS_STORAGE[$var_name], $after, $key);
		else
			quickloans_array_insert_after($QUICKLOANS_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('quickloans_storage_set_array_before')) {
	function quickloans_storage_set_array_before($var_name, $before, $key, $value='') {
		global $QUICKLOANS_STORAGE;
		if (!isset($QUICKLOANS_STORAGE[$var_name])) $QUICKLOANS_STORAGE[$var_name] = array();
		if (is_array($key))
			quickloans_array_insert_before($QUICKLOANS_STORAGE[$var_name], $before, $key);
		else
			quickloans_array_insert_before($QUICKLOANS_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('quickloans_storage_push_array')) {
	function quickloans_storage_push_array($var_name, $key, $value) {
		global $QUICKLOANS_STORAGE;
		if (!isset($QUICKLOANS_STORAGE[$var_name])) $QUICKLOANS_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($QUICKLOANS_STORAGE[$var_name], $value);
		else {
			if (!isset($QUICKLOANS_STORAGE[$var_name][$key])) $QUICKLOANS_STORAGE[$var_name][$key] = array();
			array_push($QUICKLOANS_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('quickloans_storage_pop_array')) {
	function quickloans_storage_pop_array($var_name, $key='', $defa='') {
		global $QUICKLOANS_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($QUICKLOANS_STORAGE[$var_name]) && is_array($QUICKLOANS_STORAGE[$var_name]) && count($QUICKLOANS_STORAGE[$var_name]) > 0) 
				$rez = array_pop($QUICKLOANS_STORAGE[$var_name]);
		} else {
			if (isset($QUICKLOANS_STORAGE[$var_name][$key]) && is_array($QUICKLOANS_STORAGE[$var_name][$key]) && count($QUICKLOANS_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($QUICKLOANS_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('quickloans_storage_inc_array')) {
	function quickloans_storage_inc_array($var_name, $key, $value=1) {
		global $QUICKLOANS_STORAGE;
		if (!isset($QUICKLOANS_STORAGE[$var_name])) $QUICKLOANS_STORAGE[$var_name] = array();
		if (empty($QUICKLOANS_STORAGE[$var_name][$key])) $QUICKLOANS_STORAGE[$var_name][$key] = 0;
		$QUICKLOANS_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('quickloans_storage_concat_array')) {
	function quickloans_storage_concat_array($var_name, $key, $value) {
		global $QUICKLOANS_STORAGE;
		if (!isset($QUICKLOANS_STORAGE[$var_name])) $QUICKLOANS_STORAGE[$var_name] = array();
		if (empty($QUICKLOANS_STORAGE[$var_name][$key])) $QUICKLOANS_STORAGE[$var_name][$key] = '';
		$QUICKLOANS_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('quickloans_storage_call_obj_method')) {
	function quickloans_storage_call_obj_method($var_name, $method, $param=null) {
		global $QUICKLOANS_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($QUICKLOANS_STORAGE[$var_name]) ? $QUICKLOANS_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($QUICKLOANS_STORAGE[$var_name]) ? $QUICKLOANS_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('quickloans_storage_get_obj_property')) {
	function quickloans_storage_get_obj_property($var_name, $prop, $default='') {
		global $QUICKLOANS_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($QUICKLOANS_STORAGE[$var_name]->$prop) ? $QUICKLOANS_STORAGE[$var_name]->$prop : $default;
	}
}
?>