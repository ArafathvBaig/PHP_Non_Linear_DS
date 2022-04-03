<?php

/**
 * Author -> Arafath Baig
 * PHP Version -> 8.0.9
 * Class to compute Binary Search Tree Node
 **/
class Node
{
    //public $parent;
    public $left;
    public $right;
    public $data;
    public function __construct($data)
    {
        //$this->parent = null;
        $this->left = null;
        $this->right = null;
        $this->data = $data;
    }
    // public function __toString()
    // {
    //     return $this->data;
    // }
}