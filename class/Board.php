<?php

  require_once "read_csv.php";

  class Board{

    public $board;
    public $goal_number;

    function __construct($path){
      $this->board = ReadCsv::getArrayFromCsv($path);
      $this->goal_number = count($this->board);
    }
    
    //データ取得
    function getBoard(){
      return$this->board;
    }
    function getGoalNumber(){
      return($this->goal_number);
    }
    function countTotalNumber(){//配列内の個数をカウント
      $number = count($this->board);
      if($number == 0){
          echo "データが入っていません。\n";
          echo "csvファイルでマップを作ってみよう。\n";
          exit;
      }
    }
    
    //検証用
    function printBoard(){
        print_r($this->board);
    }
  }
   //$board = new Board("../data/board.csv");
   //$board = new Board("data/board.csv");
   //$board->getBoard();
   //$board->getGoalNumber();
   //$aaa = $board->board[18];
   //print_r($aaa);
?>