<?php
/*
Plugin Name: ViralRank™
Plugin URI: http://viralrank.me/about
Description: This plugin does one thing - it will show the ViralRank of your blog posts. 
Version: 0.1.6
Author: Rex Dixon
Author URI: http://swarmsports.com
License: GPL2
*/
/*  Copyright 2013  Rex Dixon  (email : rex@swarmsports.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
add_filter('the_content', 'viralrank');
function viralrank($content){
$varvrurl = get_permalink();
$query = 'http://api.viralrank.me/?action=viralrank&url='.$varvrurl.'';
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $query);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
$data = curl_exec($ch); 
curl_close($ch); 
$data = str_replace( "{\"ViralRank\":","<a href = 'http://viralrank.me/about' target = '_blank'><strong>ViralRank</strong></a>: ", $data );
$data = $vr = str_replace("}"," ", $data );
$object = json_decode( $data ); 
return $content . $data;
}