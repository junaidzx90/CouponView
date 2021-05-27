<div class="coupon_template">
    <div class="couponshowwrapper">
        <div class="clogo">
            <?php echo ($coupon->logo)?'<img width="150px" class="logimg" src="'.($coupon->logo).'" alt="logo">':'<h1 class="demologo">YourLogo<h1>'; ?>
        </div>
        <div class="coponsplate">

            <div>
                <h4 class="ctitle"><?php echo _e($coupon->title) ?> | <?php echo $coupon->reviews; ?>.0<sup><span class="rating__icon rating__icon--star">&#9733;</span></sup></h4>
                
                <h5 class="secttl"><?php echo $coupon->subheadline; ?></h5>
                <h1 class="bonusttl"><?php echo $coupon->couponheadline; ?></h1>
                <h5 class="secttl secttl2"><?php echo $coupon->subheadline; ?></h5>
                <a href="<?php echo esc_url($coupon->target_url) ?>" target="_junaidzx90" class="getbtn">
                <span class="chead">Coupon Code</span>
                <span><?php echo _e($coupon->coupon_code) ?></span>
                </a>
            </div>
            
        </div>
    </div>
    <div class="reviews-section">
        <div class="bottomcontent">
            <h1 class="ratingnumber"><?php echo $coupon->reviews; ?>.0</h1>
            <div id="full-stars-example">
                <div class="rating-group">
                    <input class="rating__input rating__input--none" name="rating" id="rating-none" value="0" <?php echo (($coupon->reviews == 0)? 'checked': ''); ?> type="radio">
                    <label aria-label="1 star" class="rating__label"><span class="rating__icon rating__icon--star">&#9733;</span></label>
                    <input class="rating__input" name="rating" id="rating-1" value="1" <?php echo (($coupon->reviews == 1)? 'checked': ''); ?> type="radio">
                    <label aria-label="2 stars" class="rating__label"><span class="rating__icon rating__icon--star">&#9733;</span></label>
                    <input class="rating__input" name="rating" id="rating-2" value="2" <?php echo (($coupon->reviews == 2)? 'checked': ''); ?> type="radio">
                    <label aria-label="3 stars" class="rating__label"><span class="rating__icon rating__icon--star">&#9733;</span></label>
                    <input class="rating__input" name="rating" id="rating-3" value="3" <?php echo (($coupon->reviews == 3)? 'checked': ''); ?> type="radio">
                    <label aria-label="4 stars" class="rating__label"><span class="rating__icon rating__icon--star">&#9733;</span></label>
                    <input class="rating__input" name="rating" id="rating-4" value="4" <?php echo (($coupon->reviews == 4)? 'checked': ''); ?> type="radio">
                    <label aria-label="5 stars" class="rating__label"><span class="rating__icon rating__icon--star">&#9733;</span></label>
                    <input class="rating__input" name="rating" id="rating-5" value="5" <?php echo (($coupon->reviews == 5)? 'checked': ''); ?> type="radio">
                </div>
            </div>
            <h6 class="votes">(<?php echo $coupon->votes; ?> Votes)</h6>
            <div class="btnbox">
                <a target="_junaidzx90" href="<?php echo esc_url($coupon->target_url) ?>" class="playbtn">Ply Now</a>
            </div>
            <p class="linktxt"><a target="_junaidzx90" href="<?php echo esc_url($coupon->target_url) ?>"><?php echo _e(substr($coupon->description,0,40)) ?></a></p>
        </div>
    </div>
</div>