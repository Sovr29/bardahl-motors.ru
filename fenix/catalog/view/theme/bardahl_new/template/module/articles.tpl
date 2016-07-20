<?php echo $header; ?>
<div class="middle">
    <?php echo $content_top; ?>   
<div class="c-container">
    <?php if(isset($articles) && $articles) { ?>
    <div class="articles">
        <?php foreach ($articles as $article) { ?>
            <div class="article well">
                <div class="article_header"><h3><a href="<?php echo $article['href'] ?>"><?php echo $article['title'] ?></a></h3></div>
                <div class="article_description"><?php echo $article['description'] ?></div>
                <div><a href="<?php echo $article['href'] ?>" class="btn btn-default btn-primary">Подробнее</a></div>
            </div>
        <?php } ?>
    </div>
    <?php } else { ?>
        <p>На данный момент не опубликовано ни одной статьи.</p>
        <br />
    <?php } ?>
    <?php echo $content_bottom; ?>
</div>
<?php echo $footer; ?>