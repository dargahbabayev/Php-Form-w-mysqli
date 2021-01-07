<?php require_once("inside.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>MEMBERS</title>
</head>

<body>
  <?php
  @$operation = $_GET["operation"];
  @$id = $_GET["id"];

  switch ($operation):


    case "delete":
  ?>
      <table class="table  table-bordered table-hover" style="text-align:center">
        <thead>
          <tr class="table-light">
            <th><?php crud::deleteuser($id, $db); ?></th>
          </tr>
        </thead>
        <tbody>
      </table>
    <?php
      break;
    case "add":
      crud::adduser();
      break;
    case "add_last":
      crud::add_last($db);
      break;
    case "change":
      crud::changeuser($db);
      break;
    case "change_last":
      crud::change_last($db);
      break;
    case "searc_result":
    crud::search($db);

      break;
    default:

    ?>

      <div class="container">
        <h2>MEMBERS</h2> <a href="index.php?operation=add" class="btn btn-info pb-2">ADD USER HERE</a>


        <table class="table  table-bordered table-hover" style="text-align:center">
          <thead>
            <tr>
              <th colspan="8">
         
                <form action="index.php?operation=searc_result" method="POST" style=" display: inline-flex;">
                <select name="search_area">
                  <option value="Name">Name</option>
                  <option value="Surname">Surname</option>
                  <option value="City">City</option>
                  <option value="Job">Job</option>
                  <option value="Mtype">Member Types</option>
                </select>
                  <input type="text" name="search_keyword" placeholder="Search Keyword?">
                  <input type="submit" name="button" class="btn-info" value="Search">
                  
                </form>
              </th>
            </tr>

            <tr class="table-light">
              <th>Name</th>
              <th>Surname</th>
              <th>City</th>
              <th>Job</th>
              <th>Member Type</th>
              <th>Transactions</th>
            </tr>

          </thead>
          <tbody>

            <?php
            crud::crud_list($db);
            ?>

          </tbody>

        </table>
      </div>
  <?php
  endswitch;

  ?>


</body>

</html>