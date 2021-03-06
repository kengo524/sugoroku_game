<?php
  class Player{
    private string $name;
    private int $position;
    private int $have_money;//借金返済要素を入れ込む。

    public function __construct($name){
        $this->name = $name;
        $this->position = 0;
        $this->current_money = -100;//単位：万円
    }

    //データ取得
    public function getName(){
        return $this->name;
    }
    public function getPosition(){
        return $this->position; 
    }
    public function rePosition($number){
        $this->position += $number;
        if($this->position < 0){//マイナスマス効果によるスタート地点を超えて戻ることの防止
            $this->position = 0;
        }
    }

    public function getCurrentMoney(){
        return $this->current_money; 
    }
    public function changeCurrentMoney($event_money){
        $this->current_money += $event_money;
    }
  }
//   $tom = new Player("Tom");
//   print($tom->getName());
//   print($tom->getPosition());
?>