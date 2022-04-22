<?php
  class Player{
    private string $name;
    private int $position;
    //サイコロを持っている数を変数に後々いれてもよいかも。

    public function __construct($name){
        $this->name = $name;
        $this->position = 0;
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
  }
//   $tom = new Player("Tom");
//   print($tom->getName());
//   print($tom->getPosition());
?>