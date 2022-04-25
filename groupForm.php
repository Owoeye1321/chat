<?php 
session_start();
if (empty($_SESSION["name"]))
{                           
  header("Location:index.php");                          

}
echo '
<div id = "groupchat"> 
      <center style = "margin-top:10px;width:104%;">

          <form method = "POST" action="group.php" enctype ="multipart/form-data">
                <input style="width:200px;margin-bottom: 10px;" required name = "group_name"  class="form-control" placeholder="Group name" type = "text"/>
                
                <input style="width:200px;margin-bottom: 10px;"required name = "group_desc"  class="form-control" placeholder="Description" type = "text"/>

                <input type = "file" style="width:200px;margin-bottom: 10px;" required name = "profile_pic"  /><br>
                <i style="color:red; font-size:13px;">'; if (isset($_SESSION["errForGroup"])) {
                  echo $_SESSION["errForGroup"];}
                echo '</i><br>
                <input class="btn btn-success" name ="submitForm" type="submit" value="Finish" style="margin-top:0px;width:200px;margin-bottom:100px" />
              

          </form>

      </center>
</div>

';


?>
