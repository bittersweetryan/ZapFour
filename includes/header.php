<div id="header">
	<div class="container">
		<div class="row">
			<div class="fourcol">
				<h1><a href="./">ZapFour Shopping</a></h1>
			</div>
			<div class="fourcol">
					<h2>city</h2>
			</div>
			<div class="fourcol last">
					<ul id="utility">
						<li><a href="about.php">about</a></li>
						<li><a href="developers.php">developers</a></li>
						<li class="last"><a href="http://www.twitter.com/zapfour"><img alt="ZapFour Twitter" src="images/twitter.png"></a></li>
					</ul>
					<p class="right">
					<?php 
					// If we have not received a token, display the link for Foursquare webauth
					if($foursquare->GetAccessToken() == ""){ 
						echo "<a href=" . $foursquare->AuthenticationLink() . " id='foursquareloginlink'><span>Connect to this app via Foursquare</span></a>";
					}
					else{
					?>
					
					You are authenticated
					
					<?php
					}
					?>
					</p>
			</div>
		</div>
	</div>
<!-- End Header --></div>
	
<div id="navigation">
	<div class="container">
		<div class="row">
			<div class="sixcol">
				<ul id="weather">
					<li class="rain"><a href="*">56&deg;</a></li>
					<li class="snow"><a href="*">32&deg;</a></li>
					<li class="fridged"><a href="*">-2&deg;</a></li>
					<li class="warm"><a href="*">80&deg;</a></li>
					<li class="hot"><a href="*">90&deg;</a></li>
					<li class="cold"><a href="*">32&deg;</a></li>
					<li class="rain"><a href="*">56&deg;</a></li>
				</ul>
			</div>
			<div class="sixcol last">
				<ul id="checkins">
					<li><a href="*"><img alt="Work" src="images/icons/work.png"></a></li>
					<li><a href="*"><img alt="Movie" src="images/icons/movie.png"></a></li>
					<li><a href="*"><img alt="Travel" src="images/icons/travel.png"></a></li>
					<li><a href="*"><img alt="Food" src="images/icons/food.png"></a></li>
					<li><a href="*"><img alt="Shopping" src="images/icons/sale.png"></a></li>
					<li><a href="*"><img alt="Drink" src="images/icons/drink.png"></a></li>
					<li class="last"><a href="*"><img alt="Work" src="images/icons/work.png"></a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
