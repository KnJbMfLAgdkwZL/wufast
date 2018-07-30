<?php 
set_include_path(get_include_path()
                    .PATH_SEPARATOR.'components'
                    .PATH_SEPARATOR.'components/views'
                    );
function __autoload($class)
{
	require_once($class.'.php');
}
CController::Route();
