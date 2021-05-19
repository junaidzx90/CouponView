<div class="coupon_template">
    <div class="couponshowwrapper">
        <div class="coponsplate">
            <div class="clogo">
                <?php echo ($coupon->logo)?esc_url($coupon->logo):'<h1 class="demologo">YourLogo<h1>'; ?>
            </div>
            <h4 class="ctitle"><?php echo _e($coupon->title) ?></h4>

            <a href="<?php echo esc_url($coupon->target_url) ?>" target="_junayed" class="getbtn"><?php echo _e($coupon->coupon_code) ?></a>


            <div class="desc-texts">
                <p><?php echo _e($coupon->description) ?></p>
            </div>

            <div class="bottomcontent">
              
                <h6 class="verified">Verified: <?php echo _e($coupon->verified) ?></h6>
                <div id="full-stars-example">
                    <div class="rating-group">
                        <?php 
                        $rvw0 = '';
                        $rvw1 = '';
                        $rvw2 = '';
                        $rvw3 = '';
                        $rvw4 = '';
                        $rvw5 = '';
                        if($coupon->reviews == 0 || $coupon->reviews == ""){
                            $rvw0 = 'checked';
                        }else if($coupon->reviews == 1){
                            $rvw1 = 'checked';
                        }else if($coupon->reviews == 2){
                            $rvw2 = 'checked';
                        }else if($coupon->reviews == 3){
                            $rvw3 = 'checked';
                        }else if($coupon->reviews == 4){
                            $rvw4 = 'checked';
                        }else if($coupon->reviews == 5){
                            $rvw5 = 'checked';
                        }
                        ?>
                        <span>Ratings:</span>
                        <input class="rating__input rating__input--none" name="rating" id="rating-none" value="0" <?php echo $rvw0; ?> type="radio">
                        <label aria-label="No rating" class="rating__label"><i class="rating__icon rating__icon--none fa fa-ban"></i></label>
                        <label aria-label="1 star" class="rating__label"><span class="rating__icon rating__icon--star">&#9733;</span></label>
                        <input class="rating__input" name="rating" id="rating-1" value="1" <?php echo $rvw1; ?> type="radio">
                        <label aria-label="2 stars" class="rating__label"><span class="rating__icon rating__icon--star">&#9733;</span></label>
                        <input class="rating__input" name="rating" id="rating-2" value="2" <?php echo $rvw2; ?> type="radio">
                        <label aria-label="3 stars" class="rating__label"><span class="rating__icon rating__icon--star">&#9733;</span></label>
                        <input class="rating__input" name="rating" id="rating-3" value="3" <?php echo $rvw3; ?> type="radio">
                        <label aria-label="4 stars" class="rating__label"><span class="rating__icon rating__icon--star">&#9733;</span></label>
                        <input class="rating__input" name="rating" id="rating-4" value="4" <?php echo $rvw4; ?> type="radio">
                        <label aria-label="5 stars" class="rating__label"><span class="rating__icon rating__icon--star">&#9733;</span></label>
                        <input class="rating__input" name="rating" id="rating-5" value="5" <?php echo $rvw5; ?> type="radio">
                    </div>
                </div>
                <h6 class="expire">Expire: <?php echo _e($coupon->expires) ?></h6>
              
            </div>
        </div>
    </div>
</div>