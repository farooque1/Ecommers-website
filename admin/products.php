<?php
require('top.php');

$condition='';
$condition1='';
if($_SESSION['ADMIN_ROLE']==""){
  $condition=" and products.added_by='".$_SESSION['ADMIN_ID']."'";
  $condition1=" and added_by='".$_SESSION['ADMIN_ID']."'";
}

if(isset($_GET['type']) && $_GET['type']!=''){
  $type=get_safe_value($con,$_GET['type']);
  if($type=='status'){
    $operation=get_safe_value($con,$_GET['operation']);
    $id=get_safe_value($con,$_GET['id']);
    if($operation=='active'){
      $status='1';
    }else{
      $status='0';
    }
    $update_status_sql="update products set status='$status' $condition1 where id='$id'";
    mysqli_query($con,$update_status_sql);
  }
  
  if($type=='delete'){
    $id=get_safe_value($con,$_GET['id']);
    $delete_sql="delete from products where id='$id' $condition1";
    mysqli_query($con,$delete_sql);
  }
}

$sql="select products.*,categorie.categorie from products,categorie where products.categorie_id=categorie.id     
    $condition order by products.id desc";
$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
  <div class="orders">
     <div class="row">
      <div class="col-xl-12">
       <div class="card">
        <div class="card-body">
           <h4 class="box-title">Products </h4>
           <h4 class="box-link"><a href="manage_product.php">Add Product</a> </h4>
        </div>
        <div class="card-body--">
           <div class="table-stats order-table ov-h">
            <table class="table ">
             <thead>
              <tr>
                 <th class="serial">#</th>
                 <th width="2%">ID</th>
                 <th width="10%">Categories</th>
                 <th width="30%">Name</th>
                 <th width="10%">Image</th>
                 <th width="10%">MRP</th>
                 <th width="7%">Price</th>
                 <th width="7%">Qty</th>
                 <th width="26%"></th>
              </tr>
             </thead>
             <tbody>
              <?php 
              while($row=mysqli_fetch_assoc($res)){?>
              <tr>
                 <td><?php echo $row['id']?></td>
                 <td><?php echo $row['categorie']?></td>
                 <td><?php echo $row['name']?></td>
                 <td><?php echo $row['mrp']?></td>
                 <td><?php echo $row['price']?></td>
                 <td><?php echo $row['qty']?><br/>
                 
                 <?php
                 $productSoldQtyByProductId=productSoldQtyByProductId($con,$row['id']);
                 $pneding_qty=$row['qty']-$productSoldQtyByProductId;?>
                 Pending Qty <?php echo $pneding_qty?>
                 
                 </td>
                 <td>
                <?php
                if($row['status']==1){
                  echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
                }else{
                  echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
                }
                echo "<span class='badge badge-edit'><a href='manage_product.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
                
                echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";
                
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