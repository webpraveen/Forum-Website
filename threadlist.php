<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Forum-Coding forum</title>
    <style>
    body {
  min-height:433px;
}
</style>
  </head>
  <body>
  <?php include 'partials/_dbconnect.php';?>
  <?php include 'partials/_header.php';?>

 
  <?php
$id=$_GET['catid'];
$sql="SELECT * FROM `categories` WHERE categorry_id=$id"; 
$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($result)){
  $catname=$row['category_name'];
  $catdesc=$row['category_discription'];
}

?>

<?php
//discussion post karne ke liye
$showAlert=false;
$method=$_SERVER['REQUEST_METHOD'];
if($method=='POST')
{
  //insert into thread into db
  $th_title=$_POST['title'];
  $th_subject=$_POST['subject'];
  $sno=$_POST['sno'];
  $sql="INSERT INTO `threads` ( `thread_subject`, `thread_title`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_subject', '$th_title', '$id', '$sno', current_timestamp())"; 
  $result=mysqli_query($conn,$sql);
  $showAlert=true;
  if($showAlert)
  {

    
    echo '  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong> success </strong> Your Thread has been added Please wait for community to respond
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';    
      }
}
?> 
 <div class="container bg-light py-3 ">
 <div class="jumbotron">
  <h1 class="display-4">Welcome To <?php echo $catname;?> Forums</h1>
  <p class="lead"><?php echo $catdesc;?></p>
  <hr class="my-4">
  <p>This  is perr to peer forum No Spam / Advertising / Self-promote in the forums is not allowed.Do not post copyright-infringing material.Do not post “offensive” posts, links or images.Do not cross post questions.Remain respectful of other members at all times.
</p>
  <p class="lead">
    <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
  </p>
</div>
 </div>

 <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  echo '<div class="container">
 <h2 class="py-3">Start a Discussion</h2>
 <form action=" ' . $_SERVER["REQUEST_URI"]. '"method="post">
      <div class="modal-body">
     
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Problem Title</label>
    <input type="text" class="form-control" id="title"name="title" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">Keep your title as short and crisp as possible</div>
  </div>
  <input type="hidden" name="sno" value="' .$_SESSION["sno"] . '">
  
  <div class="form-group">
<label for="exampleFormControltextarea1">Elaborate Your Concern </label>

<textarea class="form-control" id="subject"name="subject"rows="3"> </textarea>
</div>
<br>
<button type="submit"class="btn btn-success">submit</button>
  </div>
     
      </form>
 </div>';
    }
 else{
  echo '
  
  <div class="container">
  <h2 class="py-3">Start a Discussion</h2>
 <p class="lead">You are not logeged in .Please login to be able to start a Discussion</P>
 </div>';
  

 }
 ?>
 
 <div class="container  "id="ques">
<h2 class="py-3">Browse question</h2>
<?php
$id=$_GET['catid'];
$sql= "SELECT * FROM `threads` WHERE thread_cat_id=$id";  
$result=mysqli_query($conn,$sql);
$noResult=true;

while($row=mysqli_fetch_assoc($result)){
  $noResult=false;
  $id=$row['thread_id'];
  $title=$row['thread_title'];
  $desc=$row['thread_subject'];
  $thread_time=$row['timestamp'];
  $thread_user_id=$row['thread_user_id'];
  $sql2="SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
  $result2=mysqli_query($conn,$sql2);
  $row2=mysqli_fetch_assoc($result2);


echo '<div class="media my-3">
  <img class="mr-3" src="img/user.png.jpg."class="mr-3" width="54x"alt="Generic placeholder image">
  <div class="media-body ">'.
    '<h5 class="mt-0"><a href="thread.php?threadid='. $id .'">  '.$title.'</a></h5>
       '.$desc.' </div>'.'<p class=" my-0">Asked By:'. $row2['user_email'] .' at ' .$thread_time .
    '</p>'.
    '</div>';

}




if($noResult)
{
  echo '<div class="jumbotron jumbotron-fluid">
  <div class="container bg-light py-4">
    <h1 class="display-4">No Result Found</p>
    <p class="lead">Be the first person to ask the question.</p>
  </div>
</div>';
}
?>      
  <?php include 'partials/_footer.php'?>

   

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    
  
  </body>
</html>