<?
    include "./common.php";

    $text1=$_REQUEST["text1"];
	$page=$_REQUEST["page"];
	$id=$_REQUEST["id"];
    $pos1=$_REQUEST["pos1"];
	$pos2=$_REQUEST["pos2"];

    $title=$_REQUEST["title"];
    $name=$_REQUEST["name"];
    $passwd=$_REQUEST["passwd"];
    $contents=$_REQUEST["contents"];
    $today = date("Y-m-d");

    $sql = "select pos2, right(pos2,1) from qa 
        where pos1=$pos1 and length(pos2)=length('$pos2')+1 and locate('$pos2',pos2)=1 
        order by pos2 desc limit 1";
    $result=mysqli_query($db, $sql); 	
    if (!$result) exit("에러: $sql");

    $count=mysqli_num_rows($result);
    if ($count > 0) 
    {
       $row=mysqli_fetch_row($result);
       $new_pos2 = ++$row[0]; //맨 끝자리 값을 다음 알파벳으로 수정한 값
    }
    else $new_pos2 = $pos2 . "A";
    
    echo $new_pos2;

    $sql="insert into qa (pos1, pos2, title ,name , passwd, count, writeday, contents)
        value ($pos1, '$new_pos2', '$title','$name','$passwd', 0,'$today', '$contents')";
    $result=mysqli_query($db, $sql); 	
    if (!$result) exit("에러: $sql");

    echo("<script>location.href='qa.php?page=$page&text1=$text1'</script>");
?>