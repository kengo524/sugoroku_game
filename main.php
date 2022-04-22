<?php

    require_once "./class/player.php";
    require_once "./class/dice.php";
    require_once "./class/board.php";
    require_once "./class/game.php";

    //gameの準備
    $game = new Game();

    //boardの準備
    $game->setBoard(new Board("data/board.csv"));

    //playerの準備
    $game->addPlayer(new Player("Taro"));
    $game->addPlayer(new Player("Jiro"));

    //diceの準備
    $game->setDice(new Dice());
   
    //gamestart
    $game->start();

?>