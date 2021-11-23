        <?php
require('connection.php');
require('top.php');
$msg='';
if(isset($_POST['submit'])){

  $categories=get_safe_value($con,$_POST['categorie']);
  $res=mysqli_query($con,"select * from categorie where categorie='$categories'");
  $check=mysqli_num_rows($res);
  if($check>0){
    if(isset($_GET['id']) && $_GET['id']!=''){
      $getData=mysqli_fetch_assoc($res);
      if($id==$getData['id']){
      
      }else{
        $msg="Categories already exist";
      }
    }else{
      $msg="Categories already exist";
    }
  }
  
  if($msg==''){
    if(isset($_GET['id']) && $_GET['id']!=''){
      mysqli_query($con,"update categorie set categorie='$categories' where id='$id'");
    }else{
      mysqli_query($con,"insert into categorie(categorie,status) values('$categories','1')");
    }
    header('location:categories.php');
    die();
  }
}
?>

         <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Add Categories</strong></div>
                        <div class="card-body card-block">
                           <form method="post">
                           <div class="form-group"><label for="company" class=" form-control-label">Name</label><input type="text" id="company" placeholder="Enter Categorie name" name="categorie" class="form-control"></div>
                           <button id="payment-button" type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                           <span id="payment-button-amount">Submit</span>
                           </button>
                        <div class="field_error"><?php echo $msg; ?></div>
                        </form>

                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

                 <?php
require('footer.php');
?>