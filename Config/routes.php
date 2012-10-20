<?php
/**
 *
 * Timetable Plugin Routes
 *
 * @author Nicolas Traeder <traeder@codebiltiy.com>
 * @package Timetable
 * @license MIT
 * @version 0.1
 * 
 */

//Router::mapResources('events');
 
Router::parseExtensions('json');
 
Router::connect('/timetable', array('controller' => 'timetable', 'action' => 'index', 'plugin' => 'timetable', 'manager' => false)); 
 
Router::connect('/manager/timetable', array('controller' => 'timetable', 'action' => 'dashboard', 'plugin' => 'timetable', 'manager' => true));


Router::connect('/events', array('controller' => 'events', 'action' => 'index', '[method]' => 'GET', 'ext' => 'json', 'plugin' => 'timetable', 'manager' => false));
Router::connect('/events/:id', array('controller' => 'events', 'action' => 'view', '[method]' => 'GET', 'ext' => 'json', 'plugin' => 'timetable', 'manager' => false),array('pass' => array('id'),'id' => '[0-9a-zA-z]+'));

Router::connect('/workshops', array('controller' => 'workshops', 'action' => 'index', '[method]' => 'GET', 'ext' => 'json', 'plugin' => 'timetable', 'manager' => false),array('pass' => array('id'),'id' => '[0-9a-zA-z]+'));
Router::connect('/workshops/:id', array('controller' => 'workshops', 'action' => 'view', '[method]' => 'GET', 'ext' => 'json', 'plugin' => 'timetable', 'manager' => false),array('pass' => array('id'),'id' => '[0-9a-zA-z]+'));

Router::connect('/speakers', array('controller' => 'speakers', 'action' => 'index', '[method]' => 'GET', 'ext' => 'json', 'plugin' => 'timetable', 'manager' => false),array('pass' => array('id'),'id' => '[0-9a-zA-z]+'));
Router::connect('/speakers/:id', array('controller' => 'speakers', 'action' => 'view', '[method]' => 'GET', 'ext' => 'json', 'plugin' => 'timetable', 'manager' => false),array('pass' => array('id'),'id' => '[0-9a-zA-z]+'));

Router::connect('/topics', array('controller' => 'topics', 'action' => 'index', '[method]' => 'GET', 'ext' => 'json', 'plugin' => 'timetable', 'manager' => false),array('pass' => array('id'),'id' => '[0-9a-zA-z]+'));
Router::connect('/topics/:id', array('controller' => 'topics', 'action' => 'view', '[method]' => 'GET', 'ext' => 'json', 'plugin' => 'timetable', 'manager' => false),array('pass' => array('id'),'id' => '[0-9a-zA-z]+'));
