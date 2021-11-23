<?php

require('connection.php');
require('top.php');
isdmin();
if (isset($_GET['type']) && $_GET['type']!='' ) {
  $type=get_safe_value($con,$_GET['type']);

if($type=='delete'){
   $id=get_safe_value($con,$_GET['id']);
   $delete="delete from user where id='$id'";
   mysqli_query($con,$delete);
}
}

$sql="select * from user order by id asc";

$res=mysqli_query($con,$sql);

?>

<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Contact Us</h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th>ID</th>
                                       <th>Name</th>
                                       <th>Email</th>
                                       <th>Mobile</th>
                                       <th>Query</th>
                                       <th>Date</th>
                                       <th>Delete</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                   <?php 
                                   while($row=mysqli_fetch_assoc($res)) 
                                    {?>
                                    <tr>
                                       <td class="serial"><?php echo $row['id']; ?></td>
                                       <td><?php echo $row['username']; ?></td>
                                       <td><?php echo $row['email']; ?></td>
                                       <td><?php echo $row['mobile']; ?></td>
                                       <td><?php echo $row['password']; ?></td>
                                       <td><?php echo $row['status']; ?></td>
                                       <td>
                                          <?php
                                          echo " <span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'> DELETE</a></span>&nbsp";
                                         ?>
                                       </td>
                                    </tr>
                                 <?php } ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
        </div>

                 <?php
require('footer.php');
?>