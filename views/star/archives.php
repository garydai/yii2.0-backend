  <link type="text/css" rel="Stylesheet" href="css/Stars/StarArchives.css" />
  <div class="middle">
    <div class="user_num"> <span>点击头像进入明星个人主页 </span><span>Click on the head into the star individual homepage</span></div>
    <div>

    	<?php $oldC = '-'; foreach ($stars as $star) { if($oldC != $star["namefirstchar"]) { $oldC = $star["namefirstchar"];?>
      		<div class="list_a">
				<img src="<?php echo '../Images/Stars/star_'.$star['namefirstchar'].'.jpg' ?>" alt=<?php echo $star["namefirstchar"] ?> />
			 </div>
       <?php } ?>
			<div class="user_l">
				<a href="http://anyixuan.hbstars.com" target="_blank">
					<img src="<?php echo $star['image']?>" alt=<?php echo $star["name"] ?> />
				</a>
			</div>
    	<?php } ?>

<br class="clear" /></div>
  </div>