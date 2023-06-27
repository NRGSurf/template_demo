<?php

require_once( 'class/view.class.php' ) ;
require_once( 'menu.php' ) ;

$view = new View() ;
$view->menu = menu() ;

$view->display( 'tmpl/index.html' ) ;

