﻿<?php include 'incl/headerone.php'; ?>
 <?php include 'incl/sidebar.php'; ?>
        <div class="grid_10">
		<?php
         if($_SERVER['REQUEST_METHOD']=='POST'){
            $title=mysqli_real_escape_string($db->link,$_POST['title']);
            $category=mysqli_real_escape_string($db->link,$_POST['cat']); 
            $body=mysqli_real_escape_string($db->link,$_POST['body']);
            $tag=mysqli_real_escape_string($db->link,$_POST['tag']);
            $authore=mysqli_real_escape_string($db->link,$_POST['authore']);
        
                //......upload img///

            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];
        
            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($title==""||$category==""||$body==""||$tag==""||$authore==""||$file_name=="")
            {
                echo "<span>Filled must not be empty </span>";
            }
               
            elseif ($file_size >1048567) 
                   {
                    echo "<span class='error'>Image Size should be less then 1MB!
                   </span>";
                    } 
            elseif (in_array($file_ext, $permited) === false)
                   {
                   echo "<span class='error'>You can upload only:-"
                  .implode(', ', $permited)."</span>";
                   } 
              else {
                 move_uploaded_file($file_temp, $uploaded_image);
                 $query = "INSERT INTO tbl_post(cat,title,body,image,author,tags)
                 VALUES('$category','$title','$body','$uploaded_image','$authore','$tag')";
                 $inserted_rows = $db->insert($query);
                 if ($inserted_rows) {
                 echo "<span class='success'>Data Inserted Successfully.
                </span>";
                 }

            else {
            echo "<span class='error'>Data Not Inserted !</span>";
                 }

                 }
                 }
        ?>

            <div class="box round first grid">
                <h2>Add New Post</h2>

            

                <div class="block">               
                 <form action="addpost.php" method="POST" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                                    <option>Select Ctegory</option>
                                      <?php 
                                      $query="SELECT *FROM tbl_category";
                                      $result=$db->select($query);
                                      if($result){
                                        while ($category=$result->fetch_assoc()) {
                                         ?>
                                    <option value="<?php echo $category['id']; ?>"> <?php echo $category['name']; ?> </option>

                                   <?php } ?>
                                <?php } ?>
                               </select>
                            </td>
                        </tr>
                   
                    
                        <tr>
                            <td>
                                <label>Date Picker</label>
                            </td>
                            <td>
                                <input type="text" id="date-picker" name="date" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="image" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"></textarea>
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tag" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Authore</label>
                            </td>
                            <td>
                                <input type="text"  name="authore" />
                            </td>
                        </tr>
						<tr>
                            <td></td>
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
     <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>

      <?php include 'incl/footer.php'; ?></body>
</html>
