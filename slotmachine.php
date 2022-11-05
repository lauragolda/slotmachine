<?php

$symbols = ["$", "@", "+", "#", "*"];
$prizes = ["$" => 5, "@" => 25, "+" => 50, "#" => 250, "*" => 500];
$slots = [
    [" ", " ", " ", " ", " "],
    [" ", " ", " ", " ", " "],
    [" ", " ", " ", " ", " "]
];
$winningCombinations = [
    [[0, 0], [0, 1], [0, 2], [0, 3], [0, 4]],
    [[1, 0], [1, 1], [1, 2], [1, 3], [1, 4]],
    [[2, 0], [2, 1], [2, 2], [2, 3], [2, 4]],
    [[0, 0], [1, 1], [2, 2], [1, 3], [0, 4]],
    [[2, 0], [1, 1], [0, 2], [1, 3], [2, 4]]
];


function displaySlots($slots)
{
    echo "{$slots[0][0]} | {$slots[0][1]} | {$slots[0][2]} | {$slots[0][3]} | {$slots[0][3]}  \n";
    echo "{$slots[1][0]} | {$slots[1][1]} | {$slots[1][2]} | {$slots[1][3]} | {$slots[1][3]}  \n";
    echo "{$slots[2][0]} | {$slots[2][1]} | {$slots[2][2]} | {$slots[2][3]} | {$slots[2][3]}  \n";
}

function board(array &$slots ,array $symbols){
    $slots= [
        [$symbols[array_rand($symbols)], $symbols[array_rand($symbols)],$symbols[array_rand($symbols)], $symbols[array_rand($symbols)], $symbols[array_rand($symbols)]],
        [$symbols[array_rand($symbols)], $symbols[array_rand($symbols)],$symbols[array_rand($symbols)], $symbols[array_rand($symbols)], $symbols[array_rand($symbols)]],
        [$symbols[array_rand($symbols)], $symbols[array_rand($symbols)],$symbols[array_rand($symbols)], $symbols[array_rand($symbols)], $symbols[array_rand($symbols)]],
    ];
}


$choice = readline("Welcome! Would you like to play? Enter Y for yes and N for no:\n");
if($choice == "N"){
    echo "Okay, byeee! :)";
    exit;
}

$playerMoney = readline("Enter the amount of money you have: ");
if($playerMoney<5){
    echo "You dont have enough money! :((";
    exit;
}


while($choice == "Y" && $playerMoney >= 5){


    echo "One spin costs 5$. \n";
    $spin = readline("Press enter to start the spin. \n");
    $playerMoney-=5;
    board($slots, $symbols);
    displaySlots($slots);
    $win = 0;
    foreach ($winningCombinations as $key => $winningCombination) {
        $count = 0;
        [$y, $x] = $winningCombination[0];
        $symbol = $slots[$y][$x];
        foreach ($winningCombination as $coordinates) {
            [$y, $x] = $coordinates;
            if ($slots[$y][$x] == $symbol) {
                $count++;
            } else break;
        }
        if ($count > 1) {
            $win += $prizes[$symbol][$count - 2];
        }
    }
    $playerMoney+=$win;
    echo $win. PHP_EOL;
    echo "You won {$win}, money left - {$playerMoney}.";

}

echo "Oh oh, you are out of money! :(  \n";









