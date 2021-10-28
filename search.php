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
  </head>
  <style>
#maincontainer {
  min-height:81vh;
}



</style>
  <body>
  <?php include 'partials/_dbconnect.php';?>
    
  <?php include 'partials/_header.php';?>
 

  <div class="container py-3 my-3"id="maincontainer">
  <h1 py-3>Search result for:<em>"" <?php echo $_GET['search']?>"</em></h1>
  <?php
  $noresults=true;
$query=$_GET["search"];
$sql="SELECT * FROM `threads` WHERE match(thread_title,thread_subject) against('$query')"; 
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
  $title=$row['thread_title'];
  $desc=$row['thread_subject']; 
  $thread_id=$row['thread_id'];
  $url="thread.php?threadid=".$thread_id;
  $noresults=false;
  //display search result
 echo' <div class="result py-3">
 <h3><a href="'.$url.'"class="text-dark">'.$title.'</a></h3>
 <p>'.$desc.'</p>       
       </div>'; 
}



if($noresults)
{
echo '<div class="jumbotron jumbotron-fluid">

<div class="container">
<p class="display-4">No result Found</p>
<p class="lead">Suggestion: <ul>
            <li> Make sure that all words are spelled correctly.</li>
            <li> Try different keywords.</li>
            <li>try more general keywords. </li>
            </p>
            </div>
            </div>';
}
  ?>     
  </div>
      
  <?php include 'partials/_footer.php'?>

   

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    
  
  </body>
</html>