<?php
    class Dice{
        private $dice_list;
    
        public function __construct(
            
        ){
            $this->dice_list = array(1,2,3,4,5,6);
        }
        //サイコロの値取得
        public function diceRoll(){
            $dice_num = array_rand($this->dice_list); 
            return $this->dice_list[$dice_num];  
        }
    }

    // $dice_a = new Dice();
    // $dice_a->diceRoll();
?>