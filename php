
<?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  echo ' <div class="container">
  <h2 class="py-3">Post a Comment</h2>
  <form action="'. $_SERVER['REQUEST_URI'].'"method="post">
       <div class="modal-body">
      
   
   <div class="form-group">
 <label for="exampleFormControltextarea1">Type your Comment</label>
 
 <textarea class="form-control" id="comment"name="comment"rows="3"> </textarea>
 </div>';
    }
 else{
  echo '  
  <div class="container">
  <h2 class="py-3">Post a Comment</h2>
 <p class="lead">You are not logeged in .Please login to be able to Post comment</P>
 </div>';
  

 }
 ?>