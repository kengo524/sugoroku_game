<?php
    require_once "player.php";
    require_once "dice.php";
    require_once "board.php";

    class Game{
        private $player_list = []; //参加者のリスト
        private $board;
        private $dice;
        private $result = [];

        public function __construct(){
        }

        //Player追加
        public function addPlayer($player){
            $this->player_list[] = $player;
        }

        // board追加
        public function setBoard($board){
            $this->board = $board;
        }

        // dice追加
        public function setDice($dice){
            $this->dice = $dice;
        }

        //サイコロ振って進む
        public function throwDice(){}

        //start!!
        public function start(){
            //案内
            echo "すごろくゲームにお集まりいただきありがとうございます！\n";
            sleep(1);
            echo "ゴールは{$this->board->goal_number}マス目にあります。\n";
            sleep(1);
            echo "今回の参加者は下記のとおりです。\n";
            sleep(1);
            foreach($this->player_list as $player){
                $player_name = $player->getName();
                echo "{$player_name}くん\n";
                sleep(1);
            }
            echo "それでは始めましょう！！\n";
            sleep(1);

            //ゴールするまでの繰り返し処理実行
            while($this->player_list){
                foreach($this->player_list as $player){
                    $player_name = $player->getName(); 
                    echo "================================================\n" ;
                    echo "{$player_name}くんの番です\n";
                    echo "Enterを押してサイコロ振ろう\n";
                    fgets(STDIN);
                    for($i=0;$i<3; $i++){
                        echo ".";
                        sleep(1);
                    }
                    $number = $this->dice->diceRoll();
                    echo "{$number}!!\n";
                    sleep(1);
                    echo "{$player_name}くんは{$number}マス進んだ。。。\n";
                    $current_position = $player->getRePosition($number);
                    sleep(1);

                    //ゴール判定
                    if($current_position == $this->board->goal_number){
                        echo "{$player_name}くんゴーーール！\n"; 
                        sleep(1);
                        echo "大変お疲れさまでした。\n";
                        break 2;                   
                    }elseif($current_position > $this->board->goal_number){
                        echo "{$player_name}くん勢いあまって、ゴール先の池に転落！！\n";
                        sleep(1);
                        echo "もう一回やり直しです。\n";
                        $number = $number * (-1);
                        $current_position = $player->getRePosition($number);
                    }

                    //停止したマスでの効果発動
                    echo "!?!?!?!?\n";
                    sleep(2);
                    $stop_position = $this->board->board[($current_position)-1];

                    if($stop_position == 0){
                        echo "しかし何も起こらなかった。\n";
                        sleep(1);
                    }else if($stop_position < 0 ){
                        echo "到達したマスは{$stop_position}マスだった。。。\n";
                        sleep(1);
                        echo "容赦なく戻される。\n";
                        $current_position = $player->getRePosition($stop_position);
                        sleep(1);
                    }else if($stop_position > 0 ){
                        echo "ラッキーマス♪♪";
                        sleep(1);
                        echo "快調に{$stop_position}進む。\n";
                        $current_position = $player->getRePosition($stop_position);
                        sleep(1);
                    }
                    
                    echo "現在の位置は{$current_position}マス目です。";
                    $remaining_position = $this->board->goal_number - $current_position;
                    echo "(ゴールまであと{$remaining_position}マス！！)\n";
                    sleep(1);
                    
                }

                
            
            }
        

            
        }


    }

?>