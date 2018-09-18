<div class="location-header redirect-header">
    <h3 class="redirect-head">Notifications</h3>
</div>

<div class="row-fluid notify">
    <div class="span12">
        <div class="notify-list">
            <?php
            if (!empty($notifications)) {
                foreach ($notifications as $key => $value) {
                    ?>
                    <li>
                        <i class="fa fa-info"></i>
                        <span class="notify-detail"><?php echo $value->notification; ?></span>
                        <i class="fa fa-check notify-check"></i>
                    </li>
                    <?php
                }
            } else {
                ?>
                <li>
                    <span class="notify-detail">No Notifications Found !!!</span>
                </li>
            <?php }
            ?>
        </div>
    </div>
</div>