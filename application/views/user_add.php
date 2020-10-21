<!DOCTYPE html>
<html lang="en">
<head>
  <title>User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <div class="row">
        <h2>User
        <span style="float:right"><a href="<?= base_url(); ?>" class="btn btn-primary">Back</a></span>
        </h2>
        <hr>
        <?= @$data; ?>
        <?php if(validation_errors()){ ?>
        <div class="alert alert-danger" role="alert">
            <?= validation_errors();?>
        </div>  
        <?php }?>
   </div>
   <form enctype="multipart/form-data" action="<?= base_url();?>welcome/user_update" method="POST">   
    <div class="form-group">
    <input type="hidden" name="id" value="<?= @$row['id']; ?>" >
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" value="<?= @$row['name']; ?>" placeholder="Enter Name" name="name">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" value="<?= @$row['email']; ?>" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label for="dob">DOB:</label>
      <input type="date" class="form-control" id="DOB" value="<?= @$row['dob']; ?>" placeholder="Enter DOB" name="dob">
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
        <select class="form-control" name="status">
            <option value="">---Status---</option>
            <option value="Active" <?= @$row['status']=='Active' ? 'selected':''; ?>>Active</option>
            <option value="Deactive" <?= @$row['status']=='Deactive' ? 'selected':''; ?>>Deactive</option>
        </select>
    </div> 
    <div class="form-group">
      <button type="submit" class="btn btn-success">Submit</button>
      </div>
  </form>
</div>


</body>
</html>
