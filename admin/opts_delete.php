<?
    include "../common.php";

    $opt_id=$_REQUEST['opt_id'];
    $opts_id=$_REQUEST['opts_id'];

    $sql="delete from opts where id=$opts_id";
    $result=mysqli_query($db,$sql); 
    if (!$result) exit("에러:$sql");

    echo("<script>location.href='opts.php?id=$opt_id'</script>");
?>