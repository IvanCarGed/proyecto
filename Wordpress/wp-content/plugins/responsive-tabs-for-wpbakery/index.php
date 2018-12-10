<?php 

	/*
	Plugin Name: Responsive Tabs For WPBakery
	Description: Display your content in tabs in easy way.
	Plugin URI: http://vcaddons.com/tabs
	Author: vcaddon
	Author URI: http://vcaddons.com
	Version: 1.0
	License: GPL2
	Text Domain: vca-tabs
	*/
	
	/*
	
	    Copyright (C) 2018  vcaddon  vcaddons@gmail.com 
	*/
	include 'plugin.class.php';
	if (class_exists('VCA_Responsive_Tabs')) {
	    $obj_init = new VCA_Responsive_Tabs;
	}

 ?>