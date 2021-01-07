<?php
$db = new mysqli("localhost", "root", "", "info") or die("Connect Error");
$db->set_charset("utf");

class crud
{

    public static function crud_list($data)
    {  //first page view
        $my_query = "select * from members";
        $take_data = $data->prepare($my_query);
        $take_data->execute();
        $result = $take_data->get_result();
        if ($result->num_rows == 0) :
            echo '   <tr class="table-danger">
           <td>Members count=0 </td>
           </tr>';
        else :
            while ($row = $result->fetch_assoc()) :
                echo ' <tr>
               <td>' . $row["Name"] . '</td>
               <td>' . $row["Surname"] . '</td>
               <td>' . $row["City"] . '</td>
               <td>' . $row["Job"] . '</td>
               <td>' . crud::crud_authority($row["Mtype"]) . '</td>
               <td style="text-align:center;"><a href="index.php?operation=change&id=' . $row["id"] . ' " class="btn btn-info" >Güncelle</a>
               <a href="index.php?operation=delete&id=' . $row["id"] . '" class="btn btn-danger" >DELETE</a>
               </td>
             </tr>';
            endwhile;
            $data->close();
        endif;
    }

    public static function crud_authority($data)
    {

        if ($data == 1) :

            return  '<p class="text-primary ">Normal User</P>';


        elseif ($data == 2) :
            return '<p class="text-warning">Special User</p>';
        elseif ($data == 3) :
            return '<p class=" text-danger">VIP User</p>';
        endif;
    }

    public static function deleteuser($data1, $data2)
    { //delete user
        if ($data1 != "") :

            $myquery = "delete from members where id=?";
            $take_data = $data2->prepare($myquery);
            $take_data->bind_param("i", $data1);
            $take_data->execute();
            $lastresult = $take_data->get_result();
            if (!$lastresult) :

                echo '<div class=" alert text-success"> DELETED :) WAIT FORWARDING  </div>';
                header("refresh:2 url=index.php");
            else :

                echo '<div class="alert text-warning"> DELETED :) EROOR  </div>';
            endif;

        else :
            echo '<div class="alert text-warning"> DELETED :) ERROR FORWARDING  </div>';
            header("refresh:2 url=index.php ");
        endif;
    }

    public static function adduser()
    {/* when click add user ,it forwards to swich-case(adduser) and
        it calls this function*/
?>
        <form action="index.php?operation=add_last" method="POST">
            <table class="table  table-bordered " style="text-align:center">
                <thead>
                    <tr>
                        <th colspan="12">Add New User</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <th colspan="4"></th>
                        <th colspan="4">Name</th>
                        <th colspan="4" style="text-align:left;"><input name="name" type="text" /></th>
                    </tr>

                    <tr>
                        <th colspan="4"></th>
                        <th colspan="4">Surname</th>
                        <th colspan="4" style="text-align:left;"><input name="surname" type="text" /></th>
                    </tr>
                    <tr>
                        <th colspan="4"></th>
                        <th colspan="4">City</th>
                        <th colspan="4" style="text-align:left;"><input name="city" type="text" /></th>
                    </tr>

                    <tr>
                        <th colspan="4"></th>
                        <th colspan="4">Job</th>
                        <th colspan="4" style="text-align:left;"><input name="job" type="text" /></th>
                    </tr>

                    <tr>
                        <th colspan="4"></th>
                        <th colspan="4">Yetki</th>
                        <th colspan="4" style="text-align:left;">
                            <select name="mtype">
                                <option value="1">Normal</option>
                                <option value="2">Special</option>
                                <option value="3">Vip</option>
                            </select>
                        </th>
                    </tr>

                    <tr>
                        <th colspan="12"><input type="submit" name="buton" class="btn btn-success" value="ADD"></th>

                    </tr>

                </tbody>


            </table>
        </form>
    <?php
    }
    public static function add_last($data)
    { //add user
        $button = $_POST["buton"];
        if ($button) :
            $name = htmlspecialchars($_POST["name"]);
            $surname = htmlspecialchars($_POST["surname"]);
            $city = htmlspecialchars($_POST["city"]);
            $job = htmlspecialchars($_POST["job"]);
            $mtype = htmlspecialchars($_POST["mtype"]);
            $mtype = intval($mtype);
            if ($name == NULL || $surname == NULL || $city == NULL || $mtype == NULL) :
                echo '<div class="alert text-warning">  Fill All Rows   </div>';
                header("refresh:2 url=index.php?operation=add");

            else :

                $myquery = "insert into Members (Name,Surname,City,Job,Mtype) VALUES (?, ?, ?, ?,?)";
                $take_data = $data->prepare($myquery);
                $take_data->bind_param("ssssi", $name, $surname, $city, $job, $mtype);
                $take_data->execute();
                $lastresult = $take_data->get_result();
                if (!$lastresult) :
                    echo '<div class="alert text-info">  ADD OLUNDU   </div>';
                    header("refresh:2 url=index.php");

                else :
                    echo '<div class="alert text-warning">  ERROR   </div>';
                    header("refresh:2 url=index.php?operation=add");
                endif;


            endif;


        else :
            echo '<div class="alert text-warning">  ERROR   </div>';
            header("refresh:2 url=index.php?operation=add");
        endif;
    }


    public static function changeuser($data)
    {
        @$id = $_GET["id"];
        $my_query = "select * from members where id=?";
        $take_data = $data->prepare($my_query);
        $take_data->bind_param("i", $id);
        $take_data->execute();
        $result = $take_data->get_result();

        // $take_data->close();
        // $data->close();
    ?>
        <form action="index.php?operation=change_last" method="POST">
            <table class="table  table-bordered " style="text-align:center">
                <thead>
                    <tr>
                        <th colspan="12">Change User</th>
                    </tr>
                </thead>
                <?php
                while ($row = $result->fetch_assoc()) :
                    echo '  <tbody>
                <tr>
                    <th colspan="4"></th>
                    <th colspan="4">Name</th>
                    <th colspan="4" style="text-align:left;"><input name="name" type="text" value="' . $row["Name"] . '" /></th>
                </tr>
    
                <tr>
                    <th colspan="4"></th>
                    <th colspan="4">Surname</th>
                    <th colspan="4" style="text-align:left;"><input name="surname" value="' . $row["Surname"] . '" /></th>
                </tr>
                <tr>
                    <th colspan="4"></th>
                    <th colspan="4">City</th>
                    <th colspan="4" style="text-align:left;"><input name="city" type="text" value="' . $row["City"] . '"" /></th>
                </tr>
    
                <tr>
                    <th colspan="4"></th>
                    <th colspan="4">Job</th>
                    <th colspan="4" style="text-align:left;"><input name="job" type="text" value="' . $row["Job"] . '"" /></th>
                </tr>
    
                <tr>
                    <th colspan="4"></th>
                    <th colspan="4">Yetki</th>
                    <th colspan="4" style="text-align:left;">
                        <select name="mtype" >
                            <option value="1">Normal</option>
                            <option value="2">Special</option>
                            <option value="3">Vip</option>
                        </select>
                        
                    </th>
                </tr>
    
                <tr>
                
                   <input name="id" type="hidden" value="' . $row["id"] . '"" />
                    <th colspan="12"><input type="submit" name="buton" class="btn btn-success" value="CHANGE"></th>
    
                </tr>
    
            </tbody>
    ';
                endwhile;
                ?>
            </table>
        </form>





<?php

    }
    public static function change_last($data)
    {
        @$button = $_POST["buton"];
        @$id = $_POST["id"];
        if ($button) :


            $name = htmlspecialchars($_POST['name']);
            $surname = htmlspecialchars($_POST['surname']);
            $city = htmlspecialchars($_POST['city']);
            $job = htmlspecialchars($_POST["job"]);
            $mtype = htmlspecialchars($_POST["mtype"]);
            $mtype = intval($mtype);
            if ($name == null || $surname == null || $city == null || $job == null || $mtype == null) :
                echo '<div class="alert text-warning">  Fill All Rows   </div>';
                header("refresh:2 url=index.php?operation=change&id=$id");
            else :
                $my_query = "Update members set Name=?,Surname=?,City=?,Job=?,Mtype=? where id=?";
                $take_data = $data->prepare($my_query);
                $take_data->bind_param("ssssii", $name, $surname, $city, $job, $mtype, $id);
                $take_data->execute();
                $lastresult = $take_data->get_result();
                if (!$lastresult) :
                    echo '<div class="alert alert-success center" role="alert">
                    Changed
                    </div>';
                    header("refresh:2 url=index.php");
                else :
                    echo '<div class="alert alert-success center" role="alert">
                    Error
                    </div>';
                    header("refresh:2 url=index.php?operation=changeuser");
                endif;

                $take_data->close();
                $data->close();
            endif;

        else :
            echo '<div class="alert alert-danger" role="alert">
          Come with button
          </div>';
            header("refresh:2 url=index.php?operation=changeuser");

        endif;
    }


    public static function search($data)
    {

        $button = $_POST["button"];
        $searc_area = htmlspecialchars($_POST["search_area"]);
        $search_keyword = htmlspecialchars($_POST["search_keyword"]);
        if ($button) :
            if ($searc_area == "Name" || $searc_area == "Surname" || $searc_area == "City" || $searc_area == "Job") :
                $my_query = "select * from MEMBERS WHERE $searc_area LIKE '%$search_keyword%'";
                $take_data = $data->prepare($my_query);
                //$take_data->bind_param("s", $searc_area);
                $take_data->execute();
                $lastresult = $take_data->get_result();
                ?>
                <table class="table  table-bordered table-hover" style="text-align:center">
                <thead>

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
                if ($lastresult->num_rows != 0) :
                    while ($row = $lastresult->fetch_assoc()) :
                        echo ' <tr>
                       <td>' . $row["Name"] . '</td>
                       <td>' . $row["Surname"] . '</td>
                       <td>' . $row["City"] . '</td>
                       <td>' . $row["Job"] . '</td>
                       <td>' . crud::crud_authority($row["Mtype"]) . '</td>
                       <td style="text-align:center;"><a href="index.php?operation=change&id=' . $row["id"] . ' " class="btn btn-info" >Güncelle</a>
                       <a href="index.php?operation=delete&id=' . $row["id"] . '" class="btn btn-danger" >DELETE</a>
                       </td>
                     </tr>';
                    endwhile;
                else :
                  
                endif;
            
              ?>
                 </tbody>

                </table>


               <?php
               
            endif;
        endif;
    }
}


?>