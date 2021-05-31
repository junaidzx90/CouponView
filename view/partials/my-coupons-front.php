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
                    <?php
                    for($i=1;$i<=5;$i++){
                        if($i <= $coupon->reviews){
                            ?>
                            <input class="rating__input rating__input--none" name="rating" id="rating-none" value="0" <?php echo (($coupon->reviews == 0)? 'checked': ''); ?> type="radio">
                            <label style="color:orange" aria-label="1 star" class="rating__label"><span class="rating__icon rating__icon--star">&#9733;</span></label>
                            <?php
                        }
                        else{
                            ?>
                            <input class="rating__input rating__input--none" name="rating" id="rating-none" value="0" <?php echo (($coupon->reviews == 0)? 'checked': ''); ?> type="radio">
                            <label style="color: rgb(136 136 136 / 55%)" aria-label="1 star" class="rating__label"><span class="rating__icon rating__icon--star">&#9733;</span></label>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <h6 class="votes">(<?php echo $coupon->votes; ?> Votes)</h6>
            <div class="btnbox">
                <a target="_junaidzx90" href="<?php echo esc_url($coupon->target_url) ?>" class="playbtn">CLAIM BONUS</a>
            </div>
            <p class="linktxt"><a target="_junaidzx90" href="<?php echo esc_url($coupon->tandc_url) ?>"><?php echo _e($coupon->tandc_texts) ?></a></p>
        </div>
    </div>
</div>