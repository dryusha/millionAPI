<?php
$mainNumbers = 50;
$starNumbers = 12;
$mainNumbersPick = 5;
$starNumbersPick = 2;


// [0 - find, 1 - percents, 2 - percents / number of number (50 or 12), 3 - level]
$arrayOfNumbers = array_fill(1, $mainNumbers, [0,0,0,'']);
$arrayOfNumbersStars = array_fill(1, $starNumbers, [0,0,0,'']);

$allTickets = array();

$onlyNumbers = array();
$onlyStars = array();


print '<pre>';
//print_r($arrayOfNumbersStars);

//$file = 'results/2004.xls';
$year = 'all';
$file = 'results/'.$year.'.txt';
$fileBr = nl2br(file_get_contents($file));

// add into array each line
$arr = explode("\n", $fileBr);


/*print count($arr);
print count($arrayOfNumbers);*/

$flagDate = false;
$z = 0;
for($i = 0; $i<count($arr); $i++){
    $exp = preg_replace('/\s+/', ' ', trim($arr[$i]));
    //print_r($exp);
    $exp = explode(' ', $exp);
    $id = $exp[0];

    if(!is_numeric($id)) continue;

    $date = $exp[1].' '.$exp[2].' '.$exp[3].' '.$exp[4];

    // Sorting by date
    if(isset($_GET['date'])){
        if($_GET['date'] == $date){
            $flagDate = true;
        }
        if($flagDate == false) continue;
    }
    //print $date;
    //print '<br>';

    $prize = $exp[12];


    //$onlyNumbers[$z] = $exp[5].' '.$exp[6].' '.$exp[7].' '.$exp[8].' '.$exp[9];

    $first = (int)$exp[5];
    $second = (int)$exp[6];
    $third = (int)$exp[7];
    $fore = (int)$exp[8];
    $five = (int)$exp[9];
    $fs = str_replace("(", "", $exp[10]);
    $ss = str_replace("(", "", $exp[11]);
    $firstStar = (int)$fs;
    $secondStar = (int)$ss;

    $onlyNumbers[$z] = [[$first, $second, $third, $fore, $five], [$firstStar, $secondStar]];
    $onlyStars[$z] = [$firstStar, $secondStar];

    $timeS = strtotime($date);
    $nNumbers = $first.'|'.$second.'|'.$third.'|'.$fore.'|'.$five.' ('.$firstStar.'T'.$secondStar.')';

    $allTickets[$z]['date'] = $date;
    $allTickets[$z]['numbers'] = $first.' '.$second.' '.$third.' '.$fore.' '.$five;
    $allTickets[$z]['stars'] = $firstStar.' '.$secondStar;

    //print $nNumbers.'</br>';

    //print $nNumbers.'<br>';
    if($_GET['except'] == 1){
        if($z != 0){
            $arrayOfNumbers[$first][0] += 1;
            $arrayOfNumbers[$second][0] += 1;
            $arrayOfNumbers[$third][0] += 1;
            $arrayOfNumbers[$fore][0] += 1;
            $arrayOfNumbers[$five][0] += 1;

            $arrayOfNumbersStars[$firstStar][0] += 1;
            $arrayOfNumbersStars[$secondStar][0] += 1;
        }
    }else{
        $arrayOfNumbers[$first][0] += 1;
        $arrayOfNumbers[$second][0] += 1;
        $arrayOfNumbers[$third][0] += 1;
        $arrayOfNumbers[$fore][0] += 1;
        $arrayOfNumbers[$five][0] += 1;

        $arrayOfNumbersStars[$firstStar][0] += 1;
        $arrayOfNumbersStars[$secondStar][0] += 1;
    }



    //print $timeS.' '.$nNumbers.'<br>';

    /*$sql = "INSERT INTO draw (numbers, date) VALUES ('".$nNumbers."', $timeS)";
    $conn->query($sql);*/
    $z++;

}

//print_r($allTickets);

$arrayOfFindNumbers = array();
$arrayOfFindNumbersStars = array();


for ($z=1; $z<=count($arrayOfNumbers); $z++){
    $arrayOfNumbers[$z][1] = round($arrayOfNumbers[$z][0] / count($allTickets) * 100);
    $arrayOfNumbers[$z][2] = $arrayOfNumbers[$z][1]/$mainNumbers;
    $arrayOfFindNumbers[$z] = $arrayOfNumbers[$z][0];
}
asort($arrayOfFindNumbers);

for ($z=1; $z<=count($arrayOfNumbersStars); $z++){
    $arrayOfNumbersStars[$z][1] = round($arrayOfNumbersStars[$z][0] / count($allTickets) * 100);
    $arrayOfNumbersStars[$z][2] = $arrayOfNumbersStars[$z][1]/$mainNumbers;
    $arrayOfFindNumbersStars[$z] = $arrayOfNumbersStars[$z][0];
}
asort($arrayOfFindNumbersStars);

//print_r($arrayOfFindNumbers);
//print_r($arrayOfFindNumbersStars);





///// CHECK FUNC START


$checkNumbers = $_GET['check'];
$checkStars = $_GET['check_s'];
$checkedResults = array();
if(isset($checkNumbers) || isset($checkStars)) {
    function getCheckedNumbersFromTickets($exp, $numbers, $index, $allTickets, $isBoth = false)
    {
        $result = array();
        $g = 0;
        if($isBoth) {
            for ($k = 0; $k < count($allTickets); $k++) {
                $n = 1;
                $selectedStars = explode(' ', $allTickets[$k]['stars']);

                for ($i = 0; $i < count($exp); $i++) {
                    if (in_array($exp[$i], $selectedStars)){
                        if ($n == count($exp)) {
                            $result[$g] = $allTickets[$k];
                            $g++;
                        }
                        $n++;
                    }

                }
            }
        }else {
            for ($k = 0; $k < count($numbers); $k++) { //all numbers
                $n = 1;
                for ($i = 0; $i < count($exp); $i++) { // numbers from GET params
                    if (in_array($exp[$i], $numbers[$k][$index])) { // is numbers from GET into all numbers
                        if ($n == count($exp)) { // check is last GET param
                            $result[$g] = $allTickets[$k];
                            $g++;
                        }
                        $n++;
                    }
                }
            }
        }

        return $result;
    }


    $exp = explode(',', $checkNumbers);
    $expStars = explode(',', $checkStars);

    $checkedNumbers = getCheckedNumbersFromTickets($exp, $onlyNumbers, 0, $allTickets);

    if(!empty($checkNumbers) && !empty($checkStars)){
        $checkedResults = getCheckedNumbersFromTickets($expStars, null, 1, $checkedNumbers, true);
    }
    else if(!empty($checkNumbers)) $checkedResults = $checkedNumbers;
    else if(!empty($checkStars)) {
        $checkedResults = getCheckedNumbersFromTickets($expStars, $onlyNumbers, 1, $allTickets);
    }
}

///// CHECK FUNC END


