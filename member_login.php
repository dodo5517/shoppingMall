<!---------------------------------------------------------------------------------------------
	제목 : 내 손으로 만드는 PHP 쇼핑몰무 (실습용 디자인 HTML)

	소속 : 인덕대학교 컴퓨터소프트웨어학과
	이름 : 교수 윤형태 (2024.02)
---------------------------------------------------------------------------------------------->
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
	function Check_Value() {
		if (!form2.uid.value) {
			alert("아이디를 입력하세요.");	form2.uid.focus();	return;
		}
		if (!form2.pwd.value) {
			alert("암호를 입력하세요.");	form2.pwd.focus();	return;
		}

		form2.submit();
	}
</script>

<!-- form2 시작 -->
<form name="form2" method="post" action="member_check.php">

<div class="row mb-0">
	<div class="col"></div>
	<div class="col" align="center">

		<h3 class="mt-5">Login</h3>
		<hr size="4px" class="m-0 mb-5">

		<table width="340" height="200" style="border:2px solid #ddd; border-radius: 10px; border-collapse:separate;" class="table-borderless">
			<tr>
				<td align="center">
				
						<table  class="table table-borderless mt-3">
						<tr height="45">
							<td width="20%">아이디</td>
							<td width="50%">
								<div class="d-inline-flex">
									<input type="text" name="uid" size="20" value="" tabindex="1" 
										class="form-control form-control-sm">
								</div>
							</td>
							<td  width="30%" rowspan="2">
								<a href="javascript:Check_Value();" tabindex="3" 
									class="btn btn-sm btn-dark text-white mx-0 pt-4" 
									style="height:75px;width:75px;">&nbsp;로그인&nbsp;</a>
							</td>
						</tr>
						<tr height="45">
							<td>암 호</td>
							<td>
								<div class="d-inline-flex">
									<input type="password" name="pwd" size="20" value="" tabindex="2" 
										class="form-control form-control-sm">
								</div>
							</td>
						</tr>
					</table>					
				
				</td>
			</tr>
			<tr><td><hr class="m-0"></td></tr>
			<tr height="50">
				<td align="center">
					<a href="member_idpw.php" class="btn btn-sm mybutton me-5"> 아이디 / 암호 찾기 </a> 
				</td>
			</tr>
		</table>

	</div>
	<div class="col"></div>
</div>

</form>

<br><br><br><br><br>

<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분 -->
<!-------------------------------------------------------------------------------------------->	
<? include "main_bottom.php"; ?>
<!-------------------------------------------------------------------------------------------->	
</div>

</body>
</html>
