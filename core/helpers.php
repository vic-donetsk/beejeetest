<?php
// return route slug from whole href
function parseRouteFromUrl (string $url) : string {
    $testArray = explode('/', explode('?',$url)[0]);
    return $testArray[count($testArray) - 1];
}
