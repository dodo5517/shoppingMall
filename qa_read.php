<!---------------------------------------------------------------------------------------------
	제목 : 내 손으로 만드는 PHP 쇼핑몰무 (실습용 디자인 HTML)

	소속 : 인덕대학교 컴퓨터소프트웨어학과
	이름 : 교수 윤형태 (2024.02)
---------------------------------------------------------------------------------------------->
<?
	include "./common.php";

	$text1=$_REQUEST["text1"];
	$page=$_REQUEST["page"];
	$id=$_REQUEST["id"];

	$sql="update qa set count=count+1 where id=$id"; //조회수 올리기
	$result=mysqli_query($db,$sql); 
    if (!$result) exit("에러:$sql");

	$sql="select * from qa where id=$id";     // id번째 자료 읽기
    $result=mysqli_query($db,$sql); 
    if (!$result) exit("에러:$sql");

	$row = mysqli_fetch_array($result);  // 1레코드 읽기
	
?>
<!doctype html>
<html lang="kr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>INDUK Mall</title>
	<link  href="css/bootstrap.min.css" rel="stylesheet">
	<link  href="css/my.css" rel="stylesheet">
	<script src="js/jquery-3.7.1.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
<!-------------------------------------------------------------------------------------------->	
<? include "main_top.php"; ?>
<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분 -->
<!-------------------------------------------------------------------------------------------->	

<!--  현재 페이지 자바스크립  -------------------------------------------->
<script>
	function Go_Reply()	{
		form2.action="qa_reply.php";
		form2.submit();
	}

	function Check_Modify()	{
		if (form2.passwd.value)
		{
			if(form2.passwd.value!== '<?=$row["passwd"];?>'){
			history.back();
			}else{
				form2.action="qa_edit.php";
				form2.submit();
			}
		}
		else
		{
			alert('암호를 입력하세요.');
			form2.passwd.focus();
		}
		return;
	}

	function Check_Delete()	{
		if (form2.passwd.value)
		{
			if(form2.passwd.value!== '<?=$row["passwd"];?>'){
			history.back();
			}else{
				form2.action="qa_delete.php";
				form2.submit();
			}
		}
		else
		{
			alert('암호를 입력하세요.');
			form2.passwd.focus();
		}
		return;
	}
</script>

<div class="row m-1  mb-0 justify-content-center">
	<div class="col" align="center">

		<h4 class="mt-5">Q & A</h4>

		<hr style="height:2px" class="mb-0">
		<table class="table table-sm m-0">
			<tr height="35">
				<td width="15%" class="bg-light">제목</td>
				<td align="left" class="px-2"><?=$title=stripslashes($row["title"]);?></td>
			</tr>
			<tr height="35">
				<td class="bg-light">작성자</td>
				<td align="left" class="px-2"><?=$row["name"];?></td>
			</tr>
			<tr height="35">
				<td class="bg-light">작성일</td>
				<td align="left" class="px-2"><?=$row["writeday"];?></td>
			</tr>
			<tr height="35">
				<td class="bg-light">조회</td>
				<td align="left" class="px-2"><?=$row["count"];?></td>
			</tr>
			<tr>
				<td valign="top" class="bg-light pt-2">내용</td>
				<td height="250" align="left" valign="top" class="p-2">
				<?$contents=stripslashes($row["contents"]); echo $contents=nl2br($contents);?>
				</td>
			</tr>
		</table>

		<!--  form2 시작 -->
		<form name="form2" method="post" action="">
		<input type="hidden" name="page" value="<?=$page;?>">
		<input type="hidden" name="text1" value="<?=$text1;?>">
		<input type="hidden" name="id" value="<?=$id;?>">
		
		<table width="100%" class="m-1">
			<tr>
				<td align="left" valign="top">
					<div class="d-inline-flex">
						<div class="input-group input-group-sm">
							<span  class="input-group-text" style="font-size:12px;">암호</span>
							<input type="password" name="passwd" size="7" 
								class="form-control bg-light" style="font-size:12px;">
						</div>
					</div>
				</td>
				<td align="right" valign="top" >
					<a href="javascript:Go_Reply();" class="btn btn-sm btn-dark text-white">답글</a>&nbsp;
					<a href="javascript:Check_Modify();" class="btn btn-sm btn-dark text-white">수정</a>&nbsp;
					<a href="javascript:Check_Delete();" class="btn btn-sm btn-dark text-white">삭제</a>&nbsp;
					<a href="javascript:history.back()" class="btn btn-sm btn-dark text-white">목록</a>&nbsp;
				</td>
			</tr>
		</table>
		
		</form>

	</div>
</div>

<br><br><br>

<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분 -->
<!-------------------------------------------------------------------------------------------->	
<? include "main_bottom.php"; ?>
<!-------------------------------------------------------------------------------------------->	
</div>

</body>
</html>
