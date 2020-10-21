<!DOCTYPE html>
<html lang="en">
<head>
  <title>User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <div class="row">
    <h2>User
      <span style="float:right"><a href="<?= base_url(); ?>add" class="btn btn-primary">Add</a></span>
    </h2>
    <hr>
    <?php if($this->session->flashdata('messageadd')){ ?>
    <div class="alert alert-success" role="alert">
        <?= $this->session->flashdata('messageadd');?>
    </div>  
    <?php }?>
  </div>
  <table class="table">
    <thead>
      <tr>
        <th>Photo</th>
        <th>Name</th>
        <th>Email</th>
        <th>DOB</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        foreach($users as $user)
        {
      ?>
      <tr>
        <td> <img src="<?= base_url(); ?>uploads/<?= $user['photo']; ?>"  height="100" width="100px"/></td>
        <td><?= $user['name'];?></td>
        <td><?= $user['email'];?></td>
        <td><?= $user['dob'];?></td>
        <td><?= $user['status'];?></td>
        <td>
          <a class="btn btn-warning" href="<?= base_url('welcome/user_edit/'.$user['id']);?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
          <a class="btn btn-danger" href="<?= base_url('welcome/user_del/'.$user['id']);?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  <?php
   if(isset($users)){
    if(isset($links))
    echo $links;
    }
  ?>
</div>

</body>
</html>
