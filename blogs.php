<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
	<title>About Jubilee Hotel</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="" />
	<meta name="author" content="http://webthemez.com" />
	<!-- css -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="materialize/css/materialize.min.css" media="screen,projection" />
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
	<link href="css/flexslider.css" rel="stylesheet" />
	<link href="css/style.css" rel="stylesheet" />
</head>


<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap');

    html {
        font-family: "Outfit", sans-serif;
    }

    .page-title {
        text-align: center;
        font-size: 4rem;
    }

    img {
        max-width:800px;
        width: 100%;
    }
    .container-blog{
        display:grid;
        grid-template-columns:repeat(2,1fr);
        grid-gap:1rem;
    }
</style>

<body>
    <div>
<header>
			<div class="navbar navbar-default navbar-static-top">
				<div class="container">

					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse"
							data-target=".navbar-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<img src="img/ricechecklg (1).png" height="80px" width="80px" alt=”site’s logo”>
						<!--<a class="navbar-brand" href="index.html"><i class="icon-info-blocks material-icons"></i>Jubilee
							Hotel</a>-->
					</div>
					<div class="navbar-collapse collapse ">
						<ul class="nav navbar-nav">
							<li class="active"><a class="waves-effect waves-dark" href="index.html">Home</a></li>
							<li><a class="waves-effect waves-dark" href="about.html">About</a></li>
							<!--<li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle waves-effect waves-dark">About Us <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a class="waves-effect waves-dark" href="about.html">Hotel</a></li>
                            <li><a class="waves-effect waves-dark" href="#">Our Team</a></li>
                            <li><a class="waves-effect waves-dark" href="#">Announcements</a></li> 
                            <li><a class="waves-effect waves-dark" href="#">Partners</a></li>
                            
                        </ul>
                    </li> -->
							
                            <li><a class="waves-effect waves-dark" href="blogs.php">Blogs</a></li>
							<li><a class="waves-effect waves-dark" href="portfolio.html">Gallery</a></li>
							<li><a class="waves-effect waves-dark" href="contact.html">Contact</a></li>
							<li><a class="waves-effect waves-dark" href="admin\login.php">Admin</a></li>
						</ul>
					</div>
					
				</div>

			</div>
		</header>
        <br>
</div>

    <p class="page-title">BLOGS</p>


    <div class="container-blog">



        <?php

        require ("./admin/connection.php");

        $conn->select_db("jubilee_access_control");

        $sql = "SELECT * FROM blogs";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                echo "<div class='blog-card'>
<img src='./admin/uploads/{$row["image_name"]}' alt=''>
<p class='blog-title'>{$row["title"]}</p>
<p class='description'>{$row["description_data"]}</p>
</div>";
            }

        } else {
            echo "No results found.";
        }
        ?>





    </div>




</body>

</html>