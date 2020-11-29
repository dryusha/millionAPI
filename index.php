<?php
//include('connect.php');
include('data.php');


die();
/*$arrayOfNumbers = array_fill(1, 50, (object) ['count' => 0, 'percent' => 0]);
$arrayOfNumbersStars = array_fill(1, 12, (object) ['count' => 0, 'percent' => 0]);*/

$f = 1;
foreach($arrayOfFindNumbers as $k => $v){
    if($f <= 5) {
        $color = "green";
    }elseif($f > 5 && $f <= 10){
        $color = "lime";
    }else if($f > 10 && $f <= 15){
        $color = "yellow";
    }else if($f > 15 && $f <= 20){
        $color = "gold";
    }else if($f > 20 && $f <= 25){
        $color = "orange";
    }else if($f > 25 && $f <= 30){
        $color = "grey";
    }else if($f > 30 && $f <= 35){
        $color = "cyan";
    }else if($f > 35 && $f <= 40){
        $color = "blue";
    }else if($f > 40 && $f <= 45){
        $color = "red";
    }else if($f > 45 && $f <= 50){
        $color = "maroon";
    }

    $arrayOfNumbers[$k][3] = $color;
    print $k." - ".$v." - ".$color." ". $f." <span style='width: 50px; height: 20px; display: inline-block; background:".$color."'></span><br>";
    $f++;
}

print '-------------------------------</br>';
$f = 1;
foreach($arrayOfFindNumbersStars as $k => $v){
    if($f <= 2) {
        $color = "green";
    }elseif($f > 2 && $f <= 4){
        $color = "lime";
    }else if($f > 4 && $f <= 6){
        $color = "yellow";
    }else if($f > 6 && $f <= 8){
        $color = "orange";
    }else if($f > 8 && $f <= 10){
        $color = "red";
    }else if($f > 10 && $f <= 12){
        $color = "maroon";
    }

    $arrayOfNumbersStars[$k][3] = $color;
    print $k." - ".$v." - ".$color." ". $f." <span style='width: 50px; height: 20px; display: inline-block; background:".$color."'></span><br>";
    $f++;
}

print '
        <table style="width: 100%; display:none;">
            <tr>
                <td>Regular numbers</td>
                <td>Find</td>
                <td>%</td>
                <td>%?</td>
            </tr>';

for($i = 1; $i<=count($arrayOfNumbers); $i++){
    print "
        <tr style='background: ".$arrayOfNumbers[$i][3].";'>
            <td>$i</td>
            <td>".$arrayOfNumbers[$i][0]."</td>
            <td>".$arrayOfNumbers[$i][1]."%</td>
            <td>".$arrayOfNumbers[$i][2]."%</td>
        </tr>
    ";
}

print "
        <tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>
        <tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>
        <tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>
        <tr>
            <td>Star numbers</td>
            <td>Find</td>
            <td>%</td>
            <td>%?</td>
        </tr>";

for($s = 1; $s<=count($arrayOfNumbersStars); $s++){
    print "
        <tr style='background: ".$arrayOfNumbersStars[$s][3].";'>
            <td>$s</td>
            <td>".$arrayOfNumbersStars[$s][0]."</td>
            <td>".$arrayOfNumbersStars[$s][1]."%</td>
            <td>".$arrayOfNumbersStars[$s][2]."%</td>
        </tr>
    ";
}



print '</table>';


/*print_r($arrayOfNumbers);
print_r($arrayOfNumbersStars);
*/
print_r(count($allTickets));

print '<table style="width: 100%">
        <tr>
            <td>Date</td>
            <td>First</td>
            <td>Second</td>
            <td>Third</td>
            <td>Four</td>
            <td>Five</td>
            <td></td>
            <td>Lucku Star</td>
            <td>Lucku Star</td>
        </tr>';

for($i = 0; $i<=count($allTickets); $i++){
    $item = $allTickets[$i];

    $number =  explode(' ', $item['numbers']);
    $star =  explode(' ', $item['stars']);

    $fNumber = $number[0];
    $sNumber = $number[1];
    $tNumber = $number[2];
    $foNumber = $number[3];
    $fiNumber = $number[4];

    $fStar = $star[0];
    $sStar = $star[1];

    print '<tr>
            <td>'.$item['date'].'</td>
            <td style="background:'.$arrayOfNumbers[$fNumber][3].'">'.$fNumber.'</td>
            <td style="background:'.$arrayOfNumbers[$sNumber][3].'">'.$sNumber.'</td>
            <td style="background:'.$arrayOfNumbers[$tNumber][3].'">'.$tNumber.'</td>
            <td style="background:'.$arrayOfNumbers[$foNumber][3].'">'.$foNumber.'</td>
            <td style="background:'.$arrayOfNumbers[$fiNumber][3].'">'.$fiNumber.'</td>
            <td></td>
            <td style="background:'.$arrayOfNumbersStars[$fStar][3].'">'.$fStar.'</td>
            <td style="background:'.$arrayOfNumbersStars[$sStar][3].'">'.$sStar.'</td>
        </tr>';
}


print '</table>';



if(isset($checkNumbers) || isset($checkStars)){

    print 'You trying check numbers '.$checkNumbers.' '.(($checkStars) ? '('.$checkStars.')' : '').' of '.count($onlyNumbers).'<br>';




    //print_r($checkedNumbers);



    //var_dump($checkedResults);


    print 'Find ....'.count($checkedResults).' results<br>';

    print '<table style="width: 100%">
        <tr>
            <td>Date</td>
            <td>First</td>
            <td>Second</td>
            <td>Third</td>
            <td>Four</td>
            <td>Five</td>
            <td></td>
            <td>Lucku Star</td>
            <td>Lucku Star</td>
        </tr>';

    for($i = 0; $i<=count($checkedResults); $i++){
        $item = $checkedResults[$i];

        $number =  explode(' ', $item['numbers']);
        $star =  explode(' ', $item['stars']);

        $fNumber = $number[0];
        $sNumber = $number[1];
        $tNumber = $number[2];
        $foNumber = $number[3];
        $fiNumber = $number[4];

        $fStar = $star[0];
        $sStar = $star[1];

        print '<tr>
            <td>'.$item['date'].'</td>
            <td style="background:'.$arrayOfNumbers[$fNumber][3].'">'.$fNumber.'</td>
            <td style="background:'.$arrayOfNumbers[$sNumber][3].'">'.$sNumber.'</td>
            <td style="background:'.$arrayOfNumbers[$tNumber][3].'">'.$tNumber.'</td>
            <td style="background:'.$arrayOfNumbers[$foNumber][3].'">'.$foNumber.'</td>
            <td style="background:'.$arrayOfNumbers[$fiNumber][3].'">'.$fiNumber.'</td>
            <td></td>
            <td style="background:'.$arrayOfNumbersStars[$fStar][3].'">'.$fStar.'</td>
            <td style="background:'.$arrayOfNumbersStars[$sStar][3].'">'.$sStar.'</td>
        </tr>';
    }


    print '</table>';

}















die();
for($k = 0; $k<count($onlyNumbers); $k++){



    //print_r($onlyNumbers[$k]);

    for($j = 0; $j<count($findFourNumbersCompare);$j++){
        if(in_array($findFourNumbersCompare[$j][0], $onlyNumbers[$k])
            && in_array($findFourNumbersCompare[$j][1], $onlyNumbers[$k])
            && in_array($findFourNumbersCompare[$j][2], $onlyNumbers[$k])
            && in_array($findFourNumbersCompare[$j][3], $onlyNumbers[$k])

        ){
            print $findFourNumbersCompare[$j][0].' '. $findFourNumbersCompare[$j][1].' '. $findFourNumbersCompare[$j][2].' '. $findFourNumbersCompare[$j][3];
            print '</br>';
            print_r($findFourNumbersCompare[$j]);
            print_r($onlyNumbers[$k]);
            print ' --------------- ';
        }
    }
}


//print_r($findTwoNumbersCompare);
die();
for($k = 0; $k<count($onlyNumbers); $k++){



    //print_r($onlyNumbers[$k]);

    for($j = 0; $j<count($findTwoNumbersCompare);$j++){
        if(in_array($findTwoNumbersCompare[$j][0], $onlyNumbers[$k]) && in_array($findTwoNumbersCompare[$j][1], $onlyNumbers[$k])){
            print $findTwoNumbersCompare[$j][0].' '. $findTwoNumbersCompare[$j][1];
            print_r($onlyNumbers[$k]);
            print ' --------------- ';
        }
    }
}




