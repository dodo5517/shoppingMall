<?
    $cookie_id=$_COOKIE["cookie_id"];
	include_once ("./common.php");
?>
<style>
	.row {
		font-family: 'Titillium Web', sans-serif;
		letter-spacing : 0.5px;
		/* background-color:#4F4538; */
	}
</style>
<!--  Title과  메뉴(로그인/회원가입/장바구니/주문조회/게시판/Q&A) -->
<div class="row" >
	<div class="col mt-3" align="right" style="font-size:15px;">
		<a href="index.php">Home</a>&nbsp;|&nbsp;
	<?  
		if (!$cookie_id) {
			echo("<a href='member_login.php'>Login</a>&nbsp;|&nbsp");
			echo("<a href='member_join.php'>Join</a>&nbsp;|&nbsp");
		}
		else {
			echo("<a href='member_logout.php'>Logout</a>&nbsp;|&nbsp");
			echo("<a href='member_edit.php'>My Page</a>&nbsp;|&nbsp");
		}
	?>
		<a href="cart.php">Cart</a>&nbsp;|&nbsp; 
		<a href="jumun_login.php">Order</a>&nbsp;|&nbsp;
		<a href="qa.php">Q & A</a>&nbsp;|&nbsp;
		<a href="faq.php">FAQ</a>&nbsp;&nbsp;
	</div>
</div>
<div class="row" >
	<div class="col fs-3" align="center">
		&nbsp;<a href="index.php"><h2 class="logo" style='font-size:45px;'>INDUK MALL</h2></a>
	</div>
</div>

<!-- Slide Images -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel"  data-bs-interval="4000">
	<div class="carousel-indicators">
		<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" aria-label="Slide 1"	class="active" aria-current="true" ></button>
		<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
		<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
		<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
	</div>
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img src="images/slide3.jpg" class="d-block w-100"alt="...">
			<div class="carousel-caption d-none d-md-block">
			</div>
		</div>
		<div class="carousel-item">
			<img src="images/slide1.jpg" class="d-block w-100"alt="...">
			<div class="carousel-caption d-none d-md-block">
			</div>
		</div>
		<div class="carousel-item">
			<img src="images/slide2.jpg" class="d-block w-100" alt="...">
			<div class="carousel-caption d-none d-md-block">
			</div>
		</div>
		<div class="carousel-item">
			<img src="images/slide4.jpg" class="d-block w-100" alt="...">
			<div class="carousel-caption d-none d-md-block">
			</div>
		</div>
	</div>
	<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Previous</span>
	</button>
	<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Next</span>
	</button>
</div>

<!--  상품 Category 메뉴/ 상품검색 -->
<div class="row m-0 p-1 fs-6" style="border-top: 1px solid #e0dbd5; border-bottom: 1px solid #e0dbd5;">
	<div class="col">
		<div class="d-flex">
			<ul class="nav me-auto">
				<?
				for ($i=1;$i<$n_menu;$i++){
					echo "<li class='nav-item zoom_a'><a class='nav-link' style='color: #4F4538;' href='menu.php?menu=".$i."'>".$a_menu[$i]."</a></li>";
				}
				?>
			</ul>

			<script>
				function check_findproduct() {
					if (!form1.find_text.value)  {
						alert('검색어를 입력하세요');
						return;
					}
					form1.submit();
				}
			</script>

			<form name="form1" method="post" action="product_search.php">
				<div class="input-group input-group-sm pt-1" >
					<!-- <span  class="input-group-text" style="font-size:13px;">SEARCH</span> -->
					<input type="text" name="find_text" value="" size="15" class="form-control form-control-sm">
					<button type="button" class="btn btn-sm btn-outline-secondary" style="font-size:13px;" 
						onClick="check_findproduct();">SEARCH</button>
				</div>
			</form>

		</div>
	</div>
</div>