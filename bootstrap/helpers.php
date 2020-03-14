<?php

if ( ! function_exists('const'))
{
    function consts($key)
    {
       return config('consts.' . $key);
    }
}
