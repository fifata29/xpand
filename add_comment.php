<?php

//add_comment.php

$connect = new PDO('mysql:host=localhost;dbname=xpandbgk_comments', 'xpandbgk_admin', 'comment_admin');

$error = '';
$comment_name = '';
$comment_content = '';
$screen_id = '';

if(empty($_POST["comment_name"]))
{
 $error .= '<p class="text-danger">Name is required</p>';
}
else
{
 $comment_name = $_POST["comment_name"];
 $screen_id = $_POST["screen_id"];
}

if(empty($_POST["comment_content"]))
{
 $error .= '<p class="text-danger">Comment is required</p>';
}
else
{
 $comment_content = $_POST["comment_content"];
}

if($error == '')
{
 $query = "
 INSERT INTO tbl_comment
 (parent_comment_id, comment, comment_sender_name, screen_id)
 VALUES (:parent_comment_id, :comment, :comment_sender_name, :screen_id)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':parent_comment_id' => $_POST["comment_id"],
   ':comment'    => $comment_content,
   ':comment_sender_name' => $comment_name,
   ':screen_id' => $screen_id
  )
 );
 $error = '<label class="text-success">Comment Added</label>';
}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>
