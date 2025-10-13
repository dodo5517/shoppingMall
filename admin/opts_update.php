<?
    include "../common.php";

    $opt_id=$_REQUEST['opt_id'];
    $opts_id=$_REQUEST['opts_id'];
    $name=$_REQUEST['name'];

    $sql="update opts set name='$name' where id=$opts_id";
    $result=mysqli_query($db, $sql); 	
    if (!$result) exit("에러: $sql");
    
    echo("<script>location.href='opts.php?id=$opt_id'</script>");
?>