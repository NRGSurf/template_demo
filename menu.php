<?php

require_once( 'class/view.class.php' ) ;

///////////////////////////////////////////////////////////////////////////////
function menu() {
  $items = [ 
    'one' => 'https://bbc.com', 
    'two' => 'https://youtube.com', 
    'three' => 'https://apple.com' 
  ] ;

  $view = new View() ;
  $view->items = $items ;
  $out = $view->render( 'tmpl/menu.html' ) ;

  return $out ;
}
// menu