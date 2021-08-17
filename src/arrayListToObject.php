<?php


namespace bolstad\JsonTools;


class arrayListToObject
{
    private $jsonData;

    function __construct($inputdata)
    {
        $this->jsonData = json_decode($inputdata);
    }

    public function process()
    {
        $newArray = array();
        foreach ($this->jsonData as $num) {
            $label = $num->field_name;
            echo "$label\n";
            $counter = 0;
            foreach ($num->values as $val) {
                $newArray[$counter][$label] = $val;
                $counter++;
            }
        }
        print_r($newArray);

    }


}