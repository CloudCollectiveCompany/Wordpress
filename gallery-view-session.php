<?php session_start();$tempVaar = $_SESSION['stack'][0]; ?>
<?php //echo $_POST['knockOut'].' punch!!---'.$tempVaar[1].'&nbsp;'.$tempVaar[2].'&nbsp;'.$tempVaar[3];?>

<?php
$stackEmUp = array($tempVaar[0], $tempVaar[1], $tempVaar[2], $tempVaar[3]);
$theTitleHolder = $tempVaar[4];
$sliced = array_slice($stackEmUp, (int)$_POST['knockOut']);
$otherSlice = array_slice($stackEmUp, 0, (int)$_POST['knockOut']);
$remainderNo = count($stackEmUp)-count($sliced);echo '----remainder=  '.$remainderNo.'--------';
$mergedStack = array_merge($sliced, $otherSlice);
array_push($mergedStack, $theTitleHolder);
echo 'stack=  ' . print_r($stackEmUp). '--------------------------end Stack';
echo 'sliced=  ' . print_r($sliced). '-----------------------end slice';
echo 'otherSliced=  ' . print_r($otherSlice). '-------------------end otherSlice';
echo 'mergedStack=  ' . print_r($mergedStack). '--------------------end mergedStack';
$_SESSION['stack'][0] = $mergedStack;
echo 'Session=  ' . print_r($_SESSION['stack'][0]). '----------------------end SESSION';
?>