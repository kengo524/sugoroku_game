<?php

    require_once "./class/Player.php";
    require_once "./class/Dice.php";
    require_once "./class/Board.php";
    require_once "./class/Game.php";
    require_once "./class/Event.php";

    //gameの準備
    $game = new Game();

    //boardの準備
    $game->setBoard(new Board("data/board.csv"));

    //playerの準備
    $game->addPlayer(new Player("Taro"));
    $game->addPlayer(new Player("Jiro"));

    //diceの準備
    $game->setDice(new Dice());

    //iventの追加
    $game->addEvent(new Event());
   
    //gamestart
    $game->start();

?>