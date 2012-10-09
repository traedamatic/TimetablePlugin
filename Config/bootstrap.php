<?php
/**
 *
 * Timetable Plugin Bootstrap
 *
 * @author Nicolas Traeder <traeder@codebiltiy.com>
 * @package Timetable
 * @license MIT
 * @version 0.1
 * 
 */

/**
 * set up the new Plugin Path
 */
App::build(array('Plugin' => array(CakePlugin::path('Timetable') . 'Plugin' .DS)));


/**
 * load needed plugins 
 */

CakePlugin::load('Markitup');

CakePlugin::load('Csscrush');

//CakePlugin::load('Mongodb');