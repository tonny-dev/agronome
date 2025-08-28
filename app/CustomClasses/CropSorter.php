<?php

namespace App\CustomClasses;
use Debugbar;

class CropSorter {
    public $percentage;
    private $cumulative;
    private $average;
    public $id;
    private $name;

    public function __construct($percentage, $cumulative, $average , $id , $name )
     {
        $this->percentage = $percentage;
        $this->cumulative = $cumulative;
        $this->average = $average;
        $this->id = $id;
        $this->name = $name;

    }

    // Getter and Setter methods for percentage
    public function getPercentage() {
        return $this->percentage;
    }

    public function setPercentage($percentage) {
        $this->percentage = $percentage;
    }



 // Getter and Setter methods for percentage
 public function getId() {
    return $this->id;
}

public function setId($id) {
    $this->id = $id;
}

    // Getter and Setter methods for cumulative
    public function getCumulative() {
        return $this->cumulative;
    }

    public function setCumulative($cumulative) {
        $this->cumulative = $cumulative;
    }

    // Getter and Setter methods for average
    public function getAverage() {
        return $this->average;
    }

    public function setAverage($average) {
        $this->average = $average;
    }
}

?>