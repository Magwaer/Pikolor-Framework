<?php
/*
* Pikolor Engine - by Pikolor
*
* @package		Pikolor Engine
* @author		Buzco Stanislav
* @copyright	Copyright (c) 2008 - 2016, Pikolor
* @link		http://pikolor.com
* @ Version : 2 Beta
* @index
*/

class RouteCollection extends \SplObjectStorage
{
    /**
     * Fetch all routers stored on this collection of router
     * and return it.
     *
     * @return array
     */
    public function all()
    {
        $_tmp = array();
        foreach($this as $objectValue)
        {
            $_tmp[] = $objectValue;
        }
        return $_tmp;
    }
}
