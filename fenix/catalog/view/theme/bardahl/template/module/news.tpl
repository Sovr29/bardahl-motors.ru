<?php if(!$isAjax){?>
<div class="table" id="news">
<?php }
$counter = 0;
foreach ($all_news as $news) {
	if($counter%3 == 0){
		if($counter > 0){
			echo '</div>';
		}
		echo '<div class="table-row">';
	}?>
    <article class="news">
        <div class="inner">
            <div class="images">
                <a href="<?php echo $news['view']; ?>"><img src="<?php echo $news['image']; ?>" alt="<?php echo $news['title']; ?>" /></a>
            </div>
			<div class="table actions">
				<div class="table-cell">
					<ul class="news-meta">
						<li><i class="fa fa-bookmark-o"></i></li>
						<li class="date"><span class="long"><?php echo $news['date_added']; ?></span></li>
					</ul>
				</div>
				<div class="table-cell">
					<ul class="share">
						<?php if ($news['youtube']){ ?>
						<li><a href="<?php echo $news['youtube']; ?>" target="_blank" rel="nofollow"><i class="fa fa-youtube"></i></a></li>
						<?php } if ($news['fb']){ ?>
						<li><a href="<?php echo $news['fb']; ?>" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i></a></li>
						<?php } if ($news['vk']){ ?>
						<li><a href="<?php echo $news['vk']; ?>" target="_blank" rel="nofollow"><i class="fa fa-vk"></i></a></li>
						<?php } if ($news['insta']){ ?>
						<li><a href="<?php echo $news['insta']; ?>" target="_blank" rel="nofollow"><i class="fa fa-instagram"></i></a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div class="h2"><a href="<?php echo $news['view']; ?>"><?php echo $news['title']; ?></a></div>
			<div class="content">
				<a href="<?php echo $news['view']; ?>">
					<?php echo $news['description']; ?>
				</a>
			</div>
        </div>
    </article>
<?php 
$counter++;
}echo '</div>'; ?>
<?php if(!$isAjax){?>
</div>
<?php if($counter == 6){?>
	<center><button class="btn btn-primary" type="button" id="loadNews">Показать еще</button></center>
<?php } ?>
<?php } ?>