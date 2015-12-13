
<link type="text/css" rel="Stylesheet" href="Css/Stars/Album.css" />


<script type="text/javascript" src="Javascript/Stars/Album.js"></script>
  <div id="content" class="wrap">
    <div class="starsDiv">
<div class="w-nitm">
<img src="../Images/gallery/all.png" alt="全部" />
<a href="#" >全部明星</a>
</div>
<div id="StarsInfoDiv">
<?php 
	$old = '-';
	for($i = 0; $i < count($stars); $i ++) { $star = $stars[$i];?>
		<?php if($star['namefirstchar'] != $old) {  
			if($old != '-') echo '</div>'; 
			$old = $star['namefirstchar']; ?>
			<div class="u-nitm">
			<img src="<?php echo '../Images/Stars/vdo_'.$star['namefirstchar'].'.png' ?>" alt="" />
	<?php }    ?> 
	<a id="<?php echo "S".$star['id'] ?>" href="#" onclick="setAlbum(<?php echo "'".$star['id']."'" ?>);"><?php echo $star['name']?></a>
	
<?php }?>
</div>

</div></div>
<?php if(count($stars)){ $fristStar = $stars[0];?>
<div class="photoDiv">
<input id="WebDomain" type="hidden" value="" />
<div id="CurStarName" w="705" h="466" val="<?php echo $fristStar['albumUrl'][0]['id']?>"><?php echo $fristStar['name']?></div>
<div id="PhotoArea">
<div id="PhotoInnerArea" style="width: 705px; height: 466px;">
<img id="CurStarImg" src="<?php echo $fristStar['albumUrl'][0]['image'] ?>" alt="" title="" style="width: 310px; height: 466px; margin-left: 197px; margin-top: 0px;" />
</div>
</div>
<div id="PhotoLoad">
<img id="" src="../Images/JQuery/loading.gif">
</div>
<div id="PhotoList" w="120" n="5" a="461" c="1">
<div id="PhotoPre" class="preNormal"></div>
<div id="PhotoTbList" style="width: 600px; height: 150px;">
<div id="PhotoInnerList" style="width: 55320px; height: 150px;">
<?php $f = 0; foreach ($stars as $star) 
		foreach ($star['albumUrl'] as $album) {?>
			<div id="<?php echo 'T'.$album['id']?>" class="photoContent" style="width: 120px; height: 150px;" s="<?php echo $star['id']?>" i="<?php echo $album['id']?>" w="427" h="640" t="<?php echo $star['name']?>" u="<?php echo $album['image'] ?>">
			<div id="<?php echo 'C'.$album['id']?>" class="<?php if(!$f) echo 'photoActive'; else echo 'photoNormal';$f = 1?>" style="width: 110px; height: 140px; margin-left: 4px; margin-top: 4px;">
			<img src="<?php echo $album['image'] ?>" alt="<?php echo $star['id']?>" title="<?php echo $star['name']?>" style="width: 86px; height: 130px; margin-left: 12px; margin-top: 5px;" onclick="changePhoto(<?php echo "'".$album['id']."'" ?>)" />
			</div>
			</div>
<?php }?>
</div>
</div>
<div id="PhotoNext" class="nextActive"></div>
</div>
</div>
<?php }?>

</div>