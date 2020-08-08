<?php
const STONE = 0;
const SCISSORS = 1;
const PAPER = 2;
const HAND_TYPE = array(
    STONE => 'グー',
    SCISSORS => 'チョキ',
    PAPER => 'パー'
);
const DRAW = 0;
const ROSE = 1;
const WIN = 2;
const GAMECONTINUE = 'y';
const GAMEEND = 'n';

function main(){
    echo "じゃんけんゲームです。あなたの手を選択して下さい\n";
    foreach(HAND_TYPE as $key => $value){
    echo "{$key}:{$value}\n";
    }
    $inputNum = getSelfHand();
    echo "あなたの手は".HAND_TYPE[$inputNum]."です\n";
    $enemyNum = getEnemyHand();
    echo "相手の手は".HAND_TYPE[$enemyNum]."です\n";
    $result = judge($inputNum,$enemyNum);
    show($result);
    if($result === DRAW){
        return main();
    }
    $answer = nextgame($result);
    if($answer === GAMECONTINUE){
        return main();
    }elseif($answer === GAMEEND){
        echo 'ゲームを終了します。お疲れさまでした';
        return;
    }
}
function getSelfHand(){
    $inputNum = trim(fgets(STDIN));
    if(checkNum($inputNum) === false){
        return main();
    }
    return $inputNum;
}
function checkNum($inputNum){
    if(is_null($inputNum)){
        echo '未入力です。番号を選択して入力して下さい';
        return false;
    }
    if(!is_numeric($inputNum)){
        echo '選択肢の数字を入力して下さい';
        return false;
    }
    if($inputNum < STONE || $inputNum > PAPER){
        echo '選択肢の中から番号を選んで下さい';
        return false;
    }
    return true;
}
function getEnemyHand(){
    return mt_rand(STONE,PAPER);
}
function judge($inputNum,$enemyNum){
    return ($inputNum - $enemyNum + 3) % 3;
}
function show($result){
    if($result === DRAW){
        echo "結果:あいこです。再度あなたの手を選択して下さい\n";
    }elseif($result === ROSE){
        echo "結果:あたなたの負けです\n";
    }elseif($result === WIN){
        echo "結果:あたなたの勝ちです\n";
    }
}
function nextgame($result){
    echo "次のゲームを行いますか？ (y/n)\n";
    $answer = trim(fgets(STDIN));
    if(checkAnswer($answer) === false){
        return nextgame($result);
    }
    return $answer;
}
function checkAnswer($answer){
    if(empty($answer)){
        echo "未入力です。答えを入力して下さい\n";
        return false;
    }
    if($answer !== GAMECONTINUE && $answer !== GAMEEND){
        echo "(y/n)のいずれかひとつを入力して下さい\n";
        return false;
    }
    return true;
}

main();

?>