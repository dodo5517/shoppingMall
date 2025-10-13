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
	
	$sql="select * from qa where id=$id";     // id번째 자료 읽기
    $result=mysqli_query($db,$sql); 
    if (!$result) exit("에러:$sql");

	$row = mysqli_fetch_array($result);  // 1레코드 읽기

	$title="Re:" . stripslashes($row["title"]); 
	$contents = stripslashes($row["contents"]); 

	$contents = ":: ++ " . $row["name"] . " 님의 글 ++::\n:: " . str_replace("\n", ":: ", $contents) . "::\n";
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

<!--  현재 페이지 자바스크립 -->
<script >
	function Check_Value() {
		if (!form2.title.value) {
			alert('글제목을 입력하여 주십시요');
			form1.title.focus();
			return;    		
		}
		if (!form2.name.value) {
			alert('이름을 입력하여 주십시요');
			form2.name.focus();
			return;    		
		}
	  if (!form2.passwd.value) {
			alert('암호를 입력하여 주십시요');
			form2.password.focus();
			return;    		
		}
		form2.submit();
	}
</script>

<!--  form2 시작 -->
<form name="form2" method="post" action="qa_insertrply.php">

<input type="hidden" name="page" value="<?=$page;?>">
<input type="hidden" name="text1" value="<?=$text1;?>">
<input type="hidden" name="id" value="<?=$id;?>">
<input type="hidden" name="pos1" value="<?=$row["pos1"];?>">
<input type="hidden" name="pos2" value="<?=$row["pos2"];?>">

<div class="row m-1  mb-0 justify-content-center">
	<div class="col" align="center">

		<h4 class="mt-5">Q & A</h4>

		<hr style="height:2px" class="mb-0">
		<table class="table table-sm m-0">
			<tr>
				<td width="15%" class="bg-light">제목</td>
				<td align="left" class="px-2">
					<div class="d-inline-flex">
						<input type="text" name="title" size="85" value="<?=$title?>"
							class="form-control form-control-sm">				
					</div>
				</td>
			</tr>
			<tr>
				<td class="bg-light">작성자</td>
				<td align="left" class="px-2">
					<div class="d-inline-flex">
						<input type="text" name="name" size="20" value="" 
							class="form-control form-control-sm">				
					</div>
				</td>
			</tr>
			<tr>
				<td class="bg-light">비밀번호</td>
				<td align="left" class="px-2">
					<div class="d-inline-flex">
						<input type="password" name="passwd" size="20" value="" 
							class="form-control form-control-sm">				
					</div>
				</td>
			</tr>
			<tr>
				<td class="bg-light">내용</td>
				<td align="left" class="p-2">
					<textarea name="contents" rows="10" cols="85" 
						class="form-control form-control-sm p-2">:: 이전 글 내용입니다.
<?=$contents;?>
					</textarea>
				</td>
			</tr>
		</table>

		<table width="100%" class="m-2">
			<tr>
				<td align="center" class="pe-2">
					<a href="javascript:Check_Value();" 
						class="btn btn-sm btn-dark text-white">저장</a>&nbsp;&nbsp;
					<a href="javascript:history.back()" 
						class="btn btn-sm btn-dark text-white">목록</a>
				</td>
			</tr>
		</table>
	
	</div>
</div>

</form>

<br><br><br>

<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분 -->
<!-------------------------------------------------------------------------------------------->	
<? include "main_bottom.php"; ?>
<!-------------------------------------------------------------------------------------------->	
</div>

</body>
</html>
