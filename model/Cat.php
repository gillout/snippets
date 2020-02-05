<?php

class Cat
{
    private $_catId;
    private $_label;

    // Getters
    public function getCatId()
    {
        return $this->_catId;
    }
    public function getLabel()
    {
        return $this->_label;
    }

    // Setters
    public function setCatId($catId)
    {
        $this->_catId = (int) $catId;
    }
    public function setLabel($label)
    {
        $this->_label = (string) $label;
    }
}
