<?php echo $header; ?><?php echo $column_left; ?>
<div id="content" >
    <div class="container">
    <h1><?php echo $heading_title ?></h1>
    <p style="text-align: left;"><?php echo $text_specialbanner ?></p>
    <div class="page-header">
        <?php if(isset($message)) echo $message ?>
        <div class="container-fluid">
            <div style="margin: auto;">
                <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
                    <input type="submit" value="<?php echo $button ?>">
                </form>
            </div>
        </div>
    </div>
    </div>

<?php echo $footer; ?>