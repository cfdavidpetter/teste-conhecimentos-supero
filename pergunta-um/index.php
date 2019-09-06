<?php

for ($i=1; $i <= 100; $i++) {

    switch (0) {
        case $i % 3 + $i % 5:
            echo 'FizzBuzz';
            break;

        case $i % 3:
            echo 'Fizz';
            break;
        
        case $i % 5:
            echo 'Buzz';
            break;
        
        default:
            echo $i;
            break;
    }

    echo "<br>";
}