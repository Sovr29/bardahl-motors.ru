
<section class="service-nav">
    <ul>
        <?php foreach ($categories as $category) { ?>
        <li>
            <a href="<?php echo $category['href']; ?>">
                <span class="icon-serv" style="background: url(<?php echo $category['image']; ?>)"></span>
                <?php echo $category['name']; ?>
            </a>
            <?php if ($category['children']) { ?>
                <article>
                <?php foreach ($category['children'] as $child) { ?>
                    <a href="<?php echo $child['href']; ?>">
                        <span class="icon-m" style="background: url(<?php echo $child['image']; ?>)"></span>
                        <?php echo $child['name']; ?>
                    </a>
                <?php } ?>
                </article>
            <?php } ?>
        </li>
        <?php } ?>        

            </ul>
</section>



