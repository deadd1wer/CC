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

$date = date("d.m.Y");
$url="http://www.bnm.org/ro/official_exchange_rates?get_xml=1&date=$date";
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

//echo $usdValue."<br/>";
//echo $usdCharCode;


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

    #Valute to MDL
    //Euro - Mdl
    if($from=='eur'){
      if($to=='mdl'){
        $result=$amount*$eurValue;
        echo $amount. " " .$eurCharCode. " &#8660; " .$result. " MDL";
      }
    }

    //Usd - Mdl
    if($from=='usd'){
      if($to=='mdl'){
        $result=$amount*$usdValue;
        echo $amount. " " .$usdCharCode. " &#8660; " .$result. " MDL";
      }
    }

    //Rub - Mdl
    if($from=='rub'){
      if($to=='mdl'){
        $result=$amount*$rubValue;
        echo $amount. " " .$rubCharCode. " &#8660; " .$result. " MDL";
      }
    }

    //Ron - Mdl
    if($from=='ron'){
      if($to=='mdl'){
        $result=$amount*$ronValue;
        echo $amount. " " .$ronCharCode. " &#8660; " .$result. " MDL";
      }
    }

    //Uah - Mdl
    if($from=='uah'){
      if($to=='mdl'){
        $result=$amount*$uahValue;
        echo $amount. " " .$uahCharCode. " &#8660; " .$result. " MDL";
      }
    }


    #------------------------------------------
    #EUR -> all

    //EUR - USD
    if($from=='eur'){
      if($to=='usd'){
        $result=$amount*$eurValue/$usdValue;
        echo $amount. " " .$eurCharCode. " &#8660; " .$result=round($result,4). " USD";
      }
    }

    //EUR - RUB
    if($from=='eur'){
      if($to=='rub'){
        $result=$amount*$eurValue/$rubValue;
        echo $amount. " " .$eurCharCode. " &#8660; " .$result=round($result,4). " RUB";
      }
    }

    //EUR - RON
    if($from=='eur'){
      if($to=='ron'){
        $result=$amount*$eurValue/$ronValue;
        echo $amount. " " .$eurCharCode. " &#8660; " .$result=round($result,4). " RON";
      }
    }

    //EUR - UAH
    if($from=='eur'){
      if($to=='uah'){
        $result=$amount*$eurValue/$uahValue;
        echo $amount. " " .$eurCharCode. " &#8660; " .$result=round($result,4). " UAH";
      }
    }

    #------------------------------------------
    #USD -> to all
    //USD - EUR
    if($from=='usd'){
      if($to=='eur'){
        $result=$amount*$usdValue/$eurValue;
        echo $amount. " " .$usdCharCode. " &#8660; " .$result=round($result,4). " EUR";
      }
    }

    //USD - RUB
    if($from=='usd'){
      if($to=='rub'){
        $result=$amount*$usdValue/$rubValue;
        echo $amount. " " .$usdCharCode. " &#8660; " .$result=round($result,4). " RUB";
      }
    }

    //USD - RON
    if($from=='usd'){
      if($to=='ron'){
        $result=$amount*$usdValue/$ronValue;
        echo $amount. " " .$usdCharCode. " &#8660; " .$result=round($result,4). " RON";
      }
    }

    //USD - UAH
    if($from=='usd'){
      if($to=='uah'){
        $result=$amount*$usdValue/$uahValue;
        echo $amount. " " .$usdCharCode. " &#8660; " .$result=round($result,4). " UAH";
      }
    }

    #------------------------------------------
    #RUB -> all

    //RUB - EUR
    if($from=='rub'){
      if($to=='eur'){
        $result=$amount*$rubValue/$eurValue;
        echo $amount. " " .$rubCharCode. " &#8660; " .$result=round($result,4). " EUR";
      }
    }

    //RUB - USD
    if($from=='rub'){
      if($to=='usd'){
        $result=$amount*$rubValue/$usdValue;
        echo $amount. " " .$rubCharCode. " &#8660; " .$result=round($result,4). " USD";
      }
    }

    //RUB - RON
    if($from=='rub'){
      if($to=='ron'){
        $result=$amount*$rubValue/$ronValue;
        echo "Подогнал $amount - $rubCharCode <br/>";
        echo "Получил на лапу ==>   " .$result=round($result,4). " RON";
        echo $amount. " " .$rubCharCode. " &#8660; " .$result=round($result,4). " RON";
      }
    }

    //RUB - UAH
    if($from=='rub'){
      if($to=='uah'){
        $result=$amount*$rubValue/$uahValue;
        echo $amount. " " .$rubCharCode. " &#8660; " .$result=round($result,4). " UAH";
      }
    }

    #------------------------------------------
    #RON->to all

    //RON - EUR
    if($from=='ron'){
      if($to=='eur'){
        $result=$amount*$ronValue/$eurValue;
        echo $amount. " " .$ronCharCode. " &#8660; " .$result=round($result,4). " EUR";
      }
    }

    //RON - USD
    if($from=='ron'){
      if($to=='usd'){
        $result=$amount*$ronValue/$usdValue;
        echo $amount. " " .$ronCharCode. " &#8660; " .$result=round($result,4). " USD";
      }
    }

    //RON - RUB
    if($from=='ron'){
      if($to=='rub'){
        $result=$amount*$ronValue/$rubValue;
        echo $amount. " " .$ronCharCode. " &#8660; " .$result=round($result,4). " RUB";
      }
    }

    //RON - UAH
    if($from=='ron'){
      if($to=='uah'){
        $result=$amount*$ronValue/$uahValue;
        echo $amount. " " .$ronCharCode. " &#8660; " .$result=round($result,4). " UAH";
      }
    }

    #------------------------------------------
    #UAH -> to all

    //UAH - EUR
    if($from=='uah'){
      if($to=='eur'){
        $result=$amount*$uahValue/$eurValue;
        echo $amount. " " .$uahCharCode. " &#8660; " .$result=round($result,4). " EUR";
      }
    }

    //UAH - USD
    if($from=='uah'){
      if($to=='usd'){
        $result=$amount*$uahValue/$usdValue;
        echo $amount. " " .$uahCharCode. " &#8660; " .$result=round($result,4). " USD";
      }
    }

    //UAH - RUB
    if($from=='uah'){
      if($to=='rub'){
        $result=$amount*$uahValue/$rubValue;
        echo $amount. " " .$uahCharCode. " &#8660; " .$result=round($result,4). " RUB";
      }
    }

    //UAH - RON
    if($from=='uah'){
      if($to=='ron'){
        $result=$amount*$uahValue/$ronValue;
        echo $amount. " " .$uahCharCode. " &#8660; " .$result=round($result,4). " RON";
      }
    }

  }
