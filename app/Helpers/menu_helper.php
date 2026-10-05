<?php

function active_menu($menu)
{
    $uri = service('uri');
    return ($uri->getSegment(1) == $menu) ? 'active' : '';
}
function active_parentmenu($menus)
{
    $uri = service('uri');
    $segment = $uri->getSegment(1);

    return in_array($segment, (array)$menus) ? 'active' : '';
}

?>