<?php
    require_once "Player.php";
    require_once "Dice.php";
    require_once "Board.php";
    require_once "Event.php";

    class Game{
        private $player_list = []; //参加者のリスト
        private $board;
        private $dice;
        private $event;

        public function __construct(){
        }

        //Player追加
        public function addPlayer($player){
            $this->player_list[] = $player;
        }

        // board追加
        public function setBoard($board){
            $this->board = $board;
            $this->board->countTotalNumber();//ボードのマス目がゼロでないか検証
        }

        // dice追加
        public function setDice($dice){
            $this->dice = $dice;
        }

        // ivent追加
        public function addEvent($event){
            $this->event = $event;
        }

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
                $player_debt_money = ($player->getCurrentMoney())*-1;
                echo "{$player_name}くん";
                echo "(現在の借金:{$player_debt_money}万円!!)\n";
                sleep(1);
            }
            echo "それでは人生一発逆転すごろくゲーム始めましょう！！\n";
            sleep(1);

            //ゴールするまでの繰り返し処理実行
            while($this->player_list){
                foreach($this->player_list as $player){
                    $player_name = $player->getName(); 
                    $player_debt_money = ($player->getCurrentMoney())*-1;
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
                    echo "{$player_name}くんは{$number}マス進んだ。。。\n\n";
                    $player->rePosition($number);
                    $current_position = $player->getPosition();
                    sleep(1);

                    //ゴール判定①(サイコロを振って出た目のゴール判定)　
                    if($current_position == $this->board->goal_number){
                        echo "{$player_name}くんゴーーール！\n"; 
                        sleep(1);
                        echo "大変お疲れさまでした。\n";
                        break 2;                   
                    }elseif($current_position > $this->board->goal_number){
                        echo "{$player_name}くん勢いあまって、ゴール先の池に転落！！\n";
                        sleep(1);
                        echo "もう一回やり直しです。\n";
                        $number = $number * (-1);//サイコロの出た目分戻る処理
                        $player->rePosition($number);//ゴール直前のスタート位置に戻る
                        $current_position = $player->getPosition();//池転落前のスタート位置取得
                    }

                    //停止したマスでの効果発動
                    echo "おや!?!?!?!?\n";
                    sleep(2);
                    $stop_position = $this->board->board[($current_position)-1];

                    if($stop_position == 0){//停止マスが0「効果なし」の場合
                        echo "しかし何も起こらなかった。\n";
                        sleep(1);
                    }else if($stop_position < 0 ){//停止マスがマイナスの場合
                        echo "到達したマスは{$stop_position}マスだった。。。\n";
                        sleep(1);
                        echo "容赦なく戻される( ﾉД`)ｼｸｼｸ…\n";
                        $player->rePosition($stop_position);
                        sleep(1);
                    }else if($stop_position > 0 ){//停止マスがプラスの場合
                        echo "ラッキーマス♪♪\n";
                        sleep(1);
                        echo "快調に+{$stop_position}進む(^O^)／\n";
                        $player->rePosition($stop_position);
                        sleep(1);
                    }
                    //停止した効果マスにより移動したあとの現在位置取得
                    $current_position = $player->getPosition();

                    //ゴール判定②(判定①とは異なり、効果マスによりゴールした時のゴール判定)　
                    if($current_position == $this->board->goal_number){
                        echo "{$player_name}くんゴーーール！\n"; 
                        sleep(1);
                        echo "大変お疲れさまでした。\n";
                        break 2;                   
                    }elseif($current_position > $this->board->goal_number){
                        echo "{$player_name}くん勢いあまって、ゴール先の池に転落！！\n";
                        sleep(1);
                        echo "もう一回やり直しです。\n";
                        $stop_position = $stop_position * (-1);
                        $player->rePosition($stop_position);
                        $current_position = $player->getPosition();
                    }

                    //現在位置の表示
                    echo "現在の位置は{$current_position}マス目です。";
                    $remaining_position = $this->board->goal_number - $current_position;
                    echo "(ゴールまであと{$remaining_position}マス！！)\n\n";
                    sleep(2);

                    //お金変動要素発生
                    $random_event = $this->event->__construct();
                    $event_detail = $this->event->getDetail($random_event);
                    $event_money = $this->event->getMoney($random_event);
                    echo "しかし、、、そこで{$player_name}くんを待ち受けるのは、、、?\n";
                    sleep(1);
                    echo "{$player_name}くんは{$event_detail}\n";
                    sleep(1);
                    echo "{$event_money}万円!!\n";
                    sleep(1);
                    $player->changeCurrentMoney($event_money);
                    $current_debt_money = ($player->getCurrentMoney())*-1;
                    if($current_debt_money < 0){
                        $print_debt_money = $current_debt_money*-1;
                        echo "現在の所持金：プラス{$print_debt_money}万円!!\n";
                    }else{
                        echo "現在の借金：{$current_debt_money}万円!!\n";
                    }


                }              
            }     
        }
    }
?>