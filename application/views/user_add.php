<?php include('header.php');?>

<div class="container">
    <div class="row">
        <h2>User
        <span style="float:right"><a href="<?= base_url("welcome"); ?>" class="btn btn-primary">Back</a></span>
        </h2>
        <hr>
        <?= @$data; ?>
        <?php if(validation_errors()){ ?>
        <div class="alert alert-danger" role="alert">
            <?= validation_errors();?>
        </div>  
        <?php }?>
   </div>

   <form action="<?= base_url();?>welcome/user_update" enctype="multipart/form-data" method="POST">   
    <div class="form-group">
    <input type="hidden" name="id" value="<?= @$row['id']; ?>" >
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" value="<?= @$row['name']; ?>" placeholder="Enter Name" name="name">
      <span id="name_error" class="text-danger"></span>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" value="<?= @$row['email']; ?>" placeholder="Enter email" name="email">
      <span id="email_error" class="text-danger"></span>
    </div>
    <div class="form-group">
      <label for="dob">DOB:</label>
      <input type="date" class="form-control" id="dob" value="<?= @$row['dob']; ?>" placeholder="Enter DOB" name="dob">
      <span id="dob_error" class="text-danger"></span>
    </div>
    <div class="form-group">
        <label for="exampleInputFile"> Photo :-  </label> <br />
      <?php if(@$row['photo']){ ?>
        <input type="hidden" name="image1" value="<?= @$row['photo']; ?>">
        <img src="<?= base_url(); ?>uploads/<?= @$row['photo']; ?>"  height="100" width="100px"/> <br /> 
      <?php } ?>
        <br />
        <input type="file" name="image" size="12" value="<?= @$row['photo']; ?>">  
    </div>  
    
    <div class="form-group">
        <label for="status">Status:</label>
        <select class="form-control" name="status" id="status">
            <option value="">---Status---</option>
            <option value="Active" <?= @$row['status']=='Active' ? 'selected':''; ?>>Active</option>
            <option value="Deactive" <?= @$row['status']=='Deactive' ? 'selected':''; ?>>Deactive</option>
        </select>
        <span id="status_error" class="text-danger"></span>
    </div> 
    <div class="form-group">
      <button type="submit" name="submit" id="submitbtn" class="btn btn-success">Submit</button>
      </div>
  </form>
  </div>
  <script type="text/javascript"> 
    $(document).ready(function(){
        $('#name_error').hide();
        $('#email_error').hide();
        $('#dob_error').hide();
        $('#status_error').hide();

        var nameErr = true;
        var emailErr = true;
        var dobErr = true;
        var statusErr = true;
        $('#name').keyup(function(){
          user_check();
        })
        function user_check(){
          var user_val = $('#name').val();
          if(user_val.length == ''){
            $('#name_error').show();
            $('#name_error').html("Please enter name");
            $('#name_error').focus();
            $('#name_error').css("color","red");
            nameErr= false;
            return false;
          }else{
            $('#name_error').hide();
            $('#name_error').html('');
          }
        }
        $('#email').keyup(function(){
          email_check();
        })
        function email_check(){
          var email_val = $('#email').val();          
          var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

          if(email_val.length == '') {  
            $('#email_error').show();
            $('#email_error').html("Please enter  email");
            $('#email_error').focus();
            $('#email_error').css("color","red");
            emailErr= false;
            return false;
          }else if(!regex.test(email_val)) {
            $('#email_error').show();
            $('#email_error').html("Please enter valid email");
            $('#email_error').focus();
            $('#email_error').css("color","red");
            emailErr= false;
            return false;
          } else{
            $('#email_error').hide();
            $('#email_error').html('');
            return true;
          }
          
        }
        
        $('#dob').keyup(function(){
          dob_check();
        })
        function dob_check(){
          var dob_val = $('#dob').val();
          if(dob_val.length == ''){
            $('#dob_error').show();
            $('#dob_error').html("Please enter dob");
            $('#dob_error').focus();
            $('#dob_error').css("color","red");
            dobErr= false;
            return false;
          }else{
            $('#dob_error').hide();
            $('#dob_error').html('');
          }
        }
        $('#status').change(function(){
          status_check();
        })
        function status_check(){
          var status_val = $('#status').val();
          console.log(status_val);
          if(status_val == ''){
            $('#status_error').show();
            $('#status_error').html("Please enter status");
            $('#status_error').focus();
            $('#status_error').css("color","red");
            statusErr= false;
            return false;
          }else{
            $('#status_error').hide();
            $('#status_error').html('');
          }
        }

        $('#submitbtn').click(function(){
          nameErr = true;
          emailErr = true;
          dobErr = true;
          statusErr = true;

          user_check();
          email_check();
          dob_check();
          status_check();
          if((nameErr==true) && (emailErr==true) && (dobErr==true) && (statusErr==true)){
            return true;
          }else{
            return false;
          }
        })
    })
</script>
  <?php include('footer.php');?>