<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 30.11.2018
 * Time: 22:29
 */


class Abc
{
    public function __construct()
    {
        echo($this->getName());
    }

    /**
     * @return string
     */
    private function getName()
    {
        return 'Davit';
    }
}