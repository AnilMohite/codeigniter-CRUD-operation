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
    <style>
        body{
            background-color:#0000;
        }
        .loginform{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 32%;
            padding: 30px;
            background: linear-gradient(45deg, #000, #000);
            color: white;
            box-shadow: 0px 2px 17px white;
        }
        .loginform .ttl{
            text-align: center;
            margin: 0 0 28px 0;
        }
    </style>
</head>

<body style="background:black">

	<div class="container">
		<div class="loginform">
            <?php if($this->session->flashdata('incorrect')) {?>
            <div class="alert alert-danger alert-dismissible">
            <strong><?php echo $this->session->flashdata('incorrect'); ?> </strong>
            </div>
            <?php }?>
            <h2 class="ttl">Admin Login</h2>
            <form action="<?= base_url(); ?>login/admin_login" method="POST">
                <div class="form-group">
                    <label for="username">User Name</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
		</div>
	</div>

</body>

</html>
