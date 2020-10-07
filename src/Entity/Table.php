<?php

namespace App\Entity;

class Table {
    private int $_num;
    private int $_min;
    private int $_max;

    public function __construct($num, $min=0, $max=20) 
    {
        $this->_num = $num;
        $this->_min = $min;
        $this->_max = $max;
    }

    public function read()
    {
        # code...
    }

    public function write() 
    {
        # code...
    }

    public function calcTable ():array
    {
        $result = array();

        for ($i=$this->_min; $i <= $this->_max; $i++) {
            $result[$i] = $i * $this->_num;
        }

        return $result;
    }

    /**
     * Get the value of _min
     */ 
    public function getMin()
    {
        return $this->_min;
    }

    /**
     * Set the value of _min
     *
     * @return  self
     */ 
    public function setMin($_min)
    {
        $this->_min = $_min;

        return $this;
    }

    /**
     * Get the value of _max
     */ 
    public function getMax()
    {
        return $this->_max;
    }

    /**
     * Set the value of _max
     *
     * @return  self
     */ 
    public function setMax($_max)
    {
        $this->_max = $_max;

        return $this;
    }
}