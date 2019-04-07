<?php

function RUN(){ // start sesji, ustawianie pol i ich zapamietywanie w sesji
    session_start();
    $CACHE="c:/temp/tictactoe.ses";
    if (isset($_POST['newgame'])){  
        clear($CACHE);
    } 
    if (isSet($_SESSION['winner'])){           
       return;
    }
    Move();
    if (file_exists($CACHE)) { // Odczyt stanu gry z pliku
        $_SESSION=array();
        $_x=file_get_contents($CACHE);  
        $_SESSION=unserialize($_x);    
    }   
    if (isset($_POST['a11'])){
        incCounter();
        $_SESSION['a11'] = turn();    
    }
    if (isset($_POST['a12'])){
        incCounter();
        $_SESSION['a12'] = turn();
    }
    if (isset($_POST['a13'])){
        incCounter();
        $_SESSION['a13']=turn();
    }
    if (isset($_POST['a21'])){
        incCounter();
        $_SESSION['a21']=turn();
    }
    if (isset($_POST['a22'])){
        incCounter();
        $_SESSION['a22']=turn();
    }
    if (isset($_POST['a23'])){
        incCounter();
        $_SESSION['a23']=turn();
    }
    if (isset($_POST['a31'])){
        incCounter();
        $_SESSION['a31']=turn();
    }
    if (isset($_POST['a32'])){
        incCounter();
        $_SESSION['a32']=turn();
    }
    if (isset($_POST['a33'])){
        incCounter();
        $_SESSION['a33']=turn();
    }   
  
    saveSession($CACHE);
}

function CheckStateOfGame(){   // sprawdzanie czy zwyciezyl X czy O
    if(IsWinner('X')=='X'){
        $_SESSION['winner'] = 'X';
        return 'X';
    }
    else if (IsWinner('O')=='O'){
        $_SESSION['winner'] = 'O';
        return 'O';
    }
    else {
        return "BRAK";
    }
}

function IsWinner($player){  // zapamietywanie w sesji mozliwosci zwyciestwa
    if (isset($_SESSION['a11']) && $_SESSION['a11']==$player && isset($_SESSION['a12']) && $_SESSION['a12']==$player && isset($_SESSION['a13']) && $_SESSION['a13']==$player){
        return $player;
    }
    if (isset($_SESSION['a21']) && $_SESSION['a21']==$player && isset($_SESSION['a22']) && $_SESSION['a22']==$player && isset($_SESSION['a23']) && $_SESSION['a23']==$player){
        return $player;
    }
    if (isset($_SESSION['a31']) && $_SESSION['a31']==$player && isset($_SESSION['a32']) && $_SESSION['a32']==$player && isset($_SESSION['a33']) && $_SESSION['a33']==$player){
        return $player;
    }
    if (isset($_SESSION['a11']) && $_SESSION['a11']==$player && isset($_SESSION['a21']) && $_SESSION['a21']==$player && isset($_SESSION['a31']) && $_SESSION['a31']==$player){
        return $player;
    }
    if (isset($_SESSION['a12']) && $_SESSION['a12']==$player && isset($_SESSION['a22']) && $_SESSION['a22']==$player && isset($_SESSION['a32']) && $_SESSION['a32']==$player){
        return $player;
    }
    if (isset($_SESSION['a13']) && $_SESSION['a13']==$player && isset($_SESSION['a23']) && $_SESSION['a23']==$player && isset($_SESSION['a33']) && $_SESSION['a33']==$player){
        return $player;
    }
    if (isset($_SESSION['a11']) && $_SESSION['a11']==$player && isset($_SESSION['a22']) && $_SESSION['a22']==$player && isset($_SESSION['a33']) && $_SESSION['a33']==$player){
        return $player;
    }
    if (isset($_SESSION['a13']) && $_SESSION['a13']==$player && isset($_SESSION['a22']) && $_SESSION['a22']==$player && isset($_SESSION['a31']) && $_SESSION['a31']==$player){
        return $player;
    }
    return "BRAK";
}

function Move(){ // ruch X/O ponadto wyswietlanie zwyciezcy 
    $winner=CheckStateOfGame();
    if ($winner !="BRAK"){
        return "Zwyciężył ".$winner;
    }
    $l=getCounter(); 
    if ($l%2==0){
        return "Player: X";
    }
    else {
        return "Player: O";
    }
}

function saveSession($CACHE){    // zapamietanie stanu gry w pliku
    file_put_contents($CACHE,serialize($_SESSION));
}
function isDisabled($v){  // funkcja odpowiedzialna za wylaczanie klawisza, ktory zostal juz raz wybrany, zeby nie bylo mozliwosci zmiany z X na O i odwrotnie
    return isset($_SESSION[$v]) ? 'disabled' : '';
}

function getValue($v) {
    return isset($_SESSION[$v]) ? $_SESSION[$v] : ""; // f. odpowiedzialna za wyswietlanie X/O
}

function getCounter(){
    if (isset($_SESSION['licznik'])){
        $licznik=$_SESSION['licznik'];
    }
    else {
        $licznik=0;
    } 
    return $licznik;
}

function incCounter(){  // getCounter/incCounter liczy kolejne ruchy graczy
    $licznik= getCounter()+1;
    $_SESSION['licznik']=$licznik;
}

function clear($CACHE){  // czyszczenie sesji :D
    unset($_SESSION['a11']);
    unset($_SESSION['a12']);
    unset($_SESSION['a13']);
    unset($_SESSION['a21']);
    unset($_SESSION['a22']);
    unset($_SESSION['a23']);
    unset($_SESSION['a31']);
    unset($_SESSION['a32']);
    unset($_SESSION['a33']);
    unset($_SESSION['winner']);
    if (file_exists($CACHE)) {
        unlink($CACHE);
    }  
}

function turn(){  // kolejny ruch- dzieki funkcji turn do sesji wprowadzany jest X badz O w zaleznosci od licznika (Counterow wyzej)
    $l=getCounter(); 
    if ($l%2==0){
        return "O";
    }
    else {
        return "X";
    }
}

?>