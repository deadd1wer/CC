<?php  include 'cc.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Currency Converter</title>
  <meta lang="en" charset="utf-8">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <style media="screen">
  .curr_form_div{
    text-align: center;
    margin-top: 10px;
    font-size: 14pt;
  }
  .curr_form{
    margin: auto;
    text-align: center;
  }
  .h3{
    text-align: center;
  }
  .t2{
    margin: auto;
    width: 200px;
  }
  .sel1{
    margin: auto;
    width: 100px;
    height: 50px;
  }
  .hegh1{
    margin: auto;
    width: 250px;
    height: 50px;
    margin-bottom: 5px;
  }
  .btn1{
    margin: auto;
    width: 250px;
    margin-top: 5px;
    background-color: #D3D3D3;
  }
  .leb1{
    display: flex;
    margin: auto;
    width: 300px;
  }
  </style>
<body>
  <div class="head">
    <h3 class="h3">Currency Converter <?php echo $date;?> </h3>
  </div>
  <div class="curr_form_div">
    <form class="curr_form" action="" method="post">
      <div class="inp_amount">
        <input type="number" name="camount" value="camount" placeholder="Enter Amount" class="form-control input-lg hegh1">
      </div>

      <div class="leb1">
        <label for="from"></label>
        <select name="from" class="form-control input-lg sel1">
          <option value="eur"><?php echo $eurCharCode; ?></option>
          <option value="usd"><?php echo $usdCharCode; ?></option>
          <option value="rub"><?php echo $rubCharCode; ?></option>
          <option value="ron"><?php echo $ronCharCode; ?></option>
          <option value="uah"><?php echo $uahCharCode; ?></option>
        </select>

        <label for="to"></label>
        <select name="to" class="form-control input-lg sel1">
          <option value="mdl">MDL</option>
          <option value="eur"><?php echo $eurCharCode; ?></option>
          <option value="usd"><?php echo $usdCharCode; ?></option>
          <option value="rub"><?php echo $rubCharCode; ?></option>
          <option value="ron"><?php echo $ronCharCode; ?></option>
          <option value="uah"><?php echo $uahCharCode; ?></option>
        </select>
      </div>

      <div class="btn_sub">
        <input type="submit" name="convert" value="CONVERT" class="btn btn-default btn1">
      </div>

    </form>
  </div>

  <h3 class="h3">EXCHANGE RATES</h3>
  <div class="tbl">
    <table class="table t2">
    <thead>
    <tr>
    <th>CASH</th>
    <th>Rates</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td> <img src="img/eur.gif" alt="#"> <?php echo $eurCharCode; ?></td>
      <td> <?php echo $eurValue; ?> </td>
    </tr>
    <tr>
      <td> <img src="img/usd.gif" alt="#"> <?php echo $usdCharCode; ?></td>
      <td><?php echo $usdValue; ?></td>
    </tr>
    <tr>
      <td> <img src="img/rub.gif" alt="#"> <?php echo $rubCharCode; ?></td>
      <td><?php echo $rubValue; ?></td>
    </tr>
    <tr>
      <td> <img src="img/ron.gif" alt="#"> <?php echo $ronCharCode; ?></td>
      <td><?php echo $ronValue; ?></td>
    </tr>
    <tr>
      <td> <img src="img/uah.gif" alt="#"> <?php echo $uahCharCode; ?></td>
      <td><?php echo $uahValue; ?></td>
    </tr>
    </tbody>
    </table>
  </div>
</body>
</html>
