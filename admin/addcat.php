﻿<?php include 'incl/headerone.php'; ?>
 <?php include 'incl/sidebar.php'; ?>
    <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
                <?php 
if($_SERVER['REQUEST_METHOD']=='POST'){
      
    $name=$_POST['name'];
    $name=mysqli_real_escape_string($db->link,$name);

    if(empty($name)){
        echo "<span class='error'> Filled must not be empty </span>";
    }else{
        $query="INSERT INTO  tbl_category(name) VALUES('$name')";
        $result=$db->insert($query);
        if($result){
          echo "<span class='success'>Insert Sucessfully </span>";
        }else{
          echo "<span class='error'> Not Inserted  </span>";
        }
    }
}


?>
                 <form action="" method="POST">
                    <table class="form">	
                     <tr>
                    
                        </tr>				
                        <tr>
                            <td>
                               
                                <input type="text" placeholder="Enter Category Name..." class="medium" name="name" />

                            </td>

                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
   <?php include 'incl/footer.php'; ?>
</body>
</html>
