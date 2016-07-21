<div id="sliderBody">
	<div class="h_wrapper">
		<span class="sliderHeader">Текущие акции</span>
		<div id="mainSlider" class="owl-carousel">
				<?php foreach ($banners as $banner) { ?>
  					<div class="sliderItem">
  						<a href="<?php echo $banner['link']; ?>">
  							<img width="610" height="220" src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" />
						</a>
  					</div>
 		 		<?php } ?>
		</div>

        <a class="sliderPrev"><img src="catalog/view/theme/bardahl_new/img/arrroPrev.png" alt=""></a>
        <a class="sliderNext"><img src="catalog/view/theme/bardahl_new/img/arrowNext.png" alt=""></a>
	</div>
</div>






