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
                            <!--
				<ul id="weather">
					<li class="rain"><a href="*" title="Rainy. Better have sweet rain boots">56&deg;</a></li>
					<li class="snow"><a href="*" title="Snowy and chilly. Get your beany and puffy coat">32&deg;</a></li>
					<li class="cloudy"><a href="*" title="Fridged cold. You need a cool scarf">-2&deg;</a></li>
					<li class="partlysunny"><a href="*" title="Soak up the rays in your sandals">80&deg;</a></li>
					<li class="thunderstorm"><a href="*" title="Too hot to handle in your sandals and hat">90&deg;</a></li>
					<li class="na"><a href="*" title="Chilly. A sweater is essential">32&deg;</a></li>
				</ul>
                            -->
                            <?PHP
                            $cont = new zapFourController();
                            $cont->getWeatherProducts(53189);
                            $fcast_html = $cont->getWeatherForecastHTML();
                            echo $fcast_html;
                            ?>
			</div>
			<div class="sixcol last">
				<ul id="checkins">
					<li><a href="*"><img alt="Work" src="images/icons/work.png" title="Design Firm"></a></li>
					<li><a href="*"><img alt="Movie" src="images/icons/movie.png" title="Marcus Theatres Menomonee Falls"></a></li>
					<li><a href="*"><img alt="Travel" src="images/icons/travel.png" title="General Mitchell International"></a></li>
					<li><a href="*"><img alt="Food" src="images/icons/food.png" title="Palms Bistro"></a></li>
					<li><a href="*"><img alt="Shopping" src="images/icons/sale.png" title="Gap Bayshore Town Center"></a></li>
					<li class="last"><a href="*"><img alt="Drink" src="images/icons/drink.png" title="Mo's Irish Pub"></a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
