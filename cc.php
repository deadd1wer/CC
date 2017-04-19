<?php
// start curl
function getPage($path){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$path);
    curl_setopt($ch, CURLOPT_FAILONERROR,1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

$date=date("d-m-Y");

if (isset($_POST['send'])) {
  $date = $_POST['calendar'];
}
else $date = date("d.m.Y");

$url="http://www.bnm.org/ro/official_exchange_rates?get_xml=1&date=".$date;
// $url="http://www.bnm.org/ro/official_exchange_rates?get_xml=1&date=07.04.2017";

$documentString=getPage($url);
$domDocument=new DOMDocument();
$domDocument->loadXML($documentString);

$domxpath = new DOMXPath($domDocument);

#----------------------------------------------------


// get node with ID=47
$nodes= $domxpath->query('//ValCurs/Valute[@ID="47"]'); //get the node
$item47=$nodes->item(0); // get  item

// get child nodes of node with ID=47
$eurCharCode=$domxpath->query('.//CharCode',$item47)->item(0)->nodeValue;
$eurValue=$domxpath->query('.//Value',$item47)->item(0)->nodeValue;


#----------------------------------------------------

// get node with ID=44
$nodes= $domxpath->query('//ValCurs/Valute[@ID="44"]'); //get the node
$item44=$nodes->item(0); // get  item

// get child nodes of node with ID=44
$usdCharCode=$domxpath->query('.//CharCode',$item44)->item(0)->nodeValue;
$usdValue=$domxpath->query('.//Value',$item44)->item(0)->nodeValue;

#----------------------------------------------------

// get node with ID=36
$nodes= $domxpath->query('//ValCurs/Valute[@ID="36"]'); //get the node
$item36=$nodes->item(0); // get  item

// get child nodes of node with ID=36
$rubCharCode=$domxpath->query('.//CharCode',$item36)->item(0)->nodeValue;
$rubValue=$domxpath->query('.//Value',$item36)->item(0)->nodeValue;

#----------------------------------------------------

// get node with ID=35
$nodes = $domxpath->query('//ValCurs/Valute[@ID="35"]'); //get the node
$item35=$nodes->item(0); // get  item

// get child nodes of node with ID=36
$ronCharCode=$domxpath->query('.//CharCode',$item35)->item(0)->nodeValue;
$ronValue=$domxpath->query('.//Value',$item35)->item(0)->nodeValue;

#----------------------------------------------------

// get node with ID=43
$nodes = $domxpath->query('//ValCurs/Valute[@ID="43"]'); //get the node
$item43=$nodes->item(0); // get  item

// get child nodes of node with ID=43
$uahCharCode=$domxpath->query('.//CharCode',$item43)->item(0)->nodeValue;
$uahValue=$domxpath->query('.//Value',$item43)->item(0)->nodeValue;

//--------------------------------------------

  if (isset($_POST['convert'])) {
    $from=$_POST['from'];
    $to=$_POST['to'];
    $amount=$_POST['camount'];

    if($amount==''||is_int($amount))
    {
      echo "Please Enter Valid Amount";
      exit();
    }

    echo '<div class="curr_form_div">';


    //get from values
    $nodesFrom= $domxpath->query('//ValCurs/Valute[@ID="'.$from.'"]');
    $itemFrom=$nodesFrom->item(0);
    $fromCharCode=$domxpath->query('.//CharCode',$itemFrom)->item(0)->nodeValue;
    $fromValue=$domxpath->query('.//Value',$itemFrom)->item(0)->nodeValue;

    //verification to mdl
    if ($to == 1){

      $toCharCode="MDL";
      $toValue=1;

    }

    else {

      //get to values
      $nodesTo= $domxpath->query('//ValCurs/Valute[@ID="'.$to.'"]'); //get the node
      $itemTo=$nodesTo->item(0); // get  item
      $toCharCode=$domxpath->query('.//CharCode',$itemTo)->item(0)->nodeValue;
      $toValue=$domxpath->query('.//Value',$itemTo)->item(0)->nodeValue;

    }

    $exRate = $fromValue/$toValue;
    $result=$amount * $exRate;

    //print $result on On the screen
    echo $amount." ".$fromCharCode. " &#8660; ".$result=round($result,4)." ".$toCharCode;

  }
