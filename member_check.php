<?
    include "common.php";

    $uid=$_REQUEST["uid"];
    $pwd=$_REQUEST["pwd"];

    $sql="select id from member where uid='$uid' and pwd='$pwd'";
    $result=mysqli_query($db,$sql);
    if (!$result) exit("에러:$sql");

    $row=mysqli_fetch_array($result);    // 1레코드 읽기
    $count=mysqli_num_rows($result); //result에 담긴 레코드 개수
    if ($count>0) {
        setcookie("cookie_id", $row["id"]); //고객번호인 id를 cookie로 저장(cookie_id)
        echo("<script>location.href='index.php'</script>"); //ndex.html로 이동.   
    } else {
        echo("<script>location.href='member_login.php'</script>"); 
        //member_login.php로 이동.
    }
?>
