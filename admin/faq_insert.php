<?
    include "../common.php";

    $title=$_REQUEST["title"];
    $title=addslashes($title);
    $contents=$_REQUEST["contents"];
    $contents=addslashes($contents);

    $sql="insert into faq (title, contents) value ('$title', '$contents')";
    $result=mysqli_query($db, $sql); 	
    if (!$result) exit("에러: $sql");

    echo("<script>location.href='faq.php'</script>");
?>