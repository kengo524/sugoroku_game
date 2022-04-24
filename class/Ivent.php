<?php
    require_once "Player.php";
    require_once "Dice.php";
    require_once "Board.php";

    class Ivent{
        private static $ivent_list = [
            "給料を受け取った!!!" => +20,
            "定期預金を解約でなんとかやりくりしたー！" => +50,
            "仮想通過で大当たりーーー！！" => +100,
            "投資詐欺でかもられたーーーー！" => -100,
            "キャバクラで豪遊してしまう。。。。" => -50,
            "交通事故にあってしまったーーー！" => -20,
        ];
        private $detail;
        private $money;

        public function __construct(){
            $this->detail = array_rand(Ivent::$ivent_list);
            $this->money = Ivent::$ivent_list[$this->detail];
        }

        // データ取得関数
        public function getDetail(){
            return $this->detail;
        }
        public function getMoney(){
            return $this->money;
        }
    }
    // $ivent = new Ivent();
    // print_r($ivent);
    // $ivent->getDetail();
    // $ivent->getMoney();
?>