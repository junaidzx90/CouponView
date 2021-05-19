<?php
wp_enqueue_style(  'my-coupons' );
wp_enqueue_script(  'my-coupons' );

$mcid = '';
$title = '';
$logo = '';
$headline = '';
$coupon_code = '';
$target_url = '';
$reviews = '';
$verified = '';
$expires = '';
$description = '';
$styles = '';
// Colors

$primarycolor = '#bfa970';
$secondarycolor = '#231f20';
$textscolors = '#ffffff';
$descriptioncolor = '#ababab';

if(isset($_POST['published']) || isset($_POST['update'])){
    if(isset($_POST['temptitle']) && !empty($_POST['temptitle']) && isset($_POST['couponcode']) && !empty($_POST['couponcode'])){
        global $wpdb;
        $couponstbl = $wpdb->prefix.'mycoupon_lists';

        $post_title = sanitize_text_field(stripslashes($_POST['temptitle']));
        $post_logo = sanitize_text_field($_POST['clogo']);
        $post_headline = sanitize_text_field(stripslashes($_POST['headline']));
        $post_coupon_code = sanitize_text_field($_POST['couponcode']);
        $post_target_url = esc_url_raw($_POST['pagelink']);
        $post_reviews_txt = floatval($_POST['reviews']);
        $post_expires_txt = ($_POST['expires']);
        $post_verified_txt = ($_POST['verified']);
        $post_description = sanitize_textarea_field(stripslashes($_POST['description']));
        $post_styles = array(
            'secondarycolor'      => isset($_POST['secondarycolor'])?$_POST['secondarycolor']:'',
            'textscolors'   => isset($_POST['textscolors'])?$_POST['textscolors']:'',
            'descriptioncolor'   => isset($_POST['descriptioncolor'])?$_POST['descriptioncolor']:'',
            'primarycolor'       => isset($_POST['primarycolor'])?$_POST['primarycolor']:''
        );

        if(isset($_POST['mcid']) && !empty($_POST['mcid'])){
            $results = $wpdb->get_var("SELECT ID FROM {$wpdb->prefix}mycoupon_lists WHERE ID = {$_POST['mcid']}");

            if($results){
                $wpdb->update($couponstbl, array(
                    'title' => $post_title,
                    'logo' => $post_logo,
                    'headline' => $post_headline,
                    'coupon_code' => $post_coupon_code,
                    'target_url' => $post_target_url,
                    'reviews' => $post_reviews_txt,
                    'expires' => $post_expires_txt,
                    'verified' => $post_verified_txt,
                    'description' => $post_description,
                    'styles' => json_encode($post_styles),
                ),array(
                    'ID' => $_POST['mcid']
                ),array(
                    '%s','%s','%s','%s','%s','%f','%s','%s','%s','%s'
                ),array(
                    '%d'
                ));
            }
        }else{
            // IF data is new
            $wpdb->insert($couponstbl, array(
                'title' => $post_title,
                'logo' => $post_logo,
                'headline' => $post_headline,
                'coupon_code' => $post_coupon_code,
                'target_url' => $post_target_url,
                'reviews' => $post_reviews_txt,
                'expires' => $post_expires_txt,
                'verified' => $post_verified_txt,
                'description' => $post_description,
                'styles' => json_encode($post_styles),
            ),array(
                '%s','%s','%s','%s','%s','%f','%s','%s','%s','%s'
            ));

            if(!is_wp_error( $wpdb )){
                wp_safe_redirect( menu_page_url('my-coupons') );
                exit;
            }
        }
    }
}

// Get Data If request for view
if(isset($_REQUEST['mc'])){
    global $wpdb;
    $mcid = intval($_REQUEST['mc']);
    $coupon = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}mycoupon_lists WHERE ID = $mcid");
    if(!empty($coupon) && !is_wp_error( $coupon )){
        $title = $coupon->title;
        $logo = $coupon->logo;
        $headline = $coupon->headline;
        $coupon_code = $coupon->coupon_code;
        $target_url = $coupon->target_url;
        $reviews = $coupon->reviews;
        $expires = $coupon->expires;
        $verified = $coupon->verified;
        $description = $coupon->description;
        $styles = json_decode($coupon->styles,true);
    }

    // Added colors into veriables
    $secondarycolor = (!empty($styles['secondarycolor'])?$styles['secondarycolor']: $secondarycolor);
    $textscolors = (!empty($styles['textscolors'])?$styles['textscolors']: $textscolors);
    $descriptioncolor = (!empty($styles['descriptioncolor'])?$styles['descriptioncolor']: $descriptioncolor);
    $primarycolor = (!empty($styles['primarycolor'])?$styles['primarycolor']:$primarycolor);
}
?>

<h1>Add new coupon</h1>
<hr>
<div id="couponaddnewwrapper">
    <form action="" method="post">
        <div id="couponaddnew">
            <table id="couponaddform">
                <tbody>
                    <tr>
                        <th>Coupon Title</th>
                        <td> <input type="text" placeholder="Title" name="temptitle" value="<?php echo __($title, 'my-coupons') ?>"> </td>
                    </tr>
                    <tr><td><hr><td></tr>
                    <tr>
                        <th>Logo</th>
                        <td> <input type="url" placeholder="Logo url" name="clogo" value="<?php echo __($logo, 'my-coupons') ?>"> </td>
                    </tr>
                    <tr>
                        <th>Headline</th>
                        <td> <input type="text" placeholder="Headline" name="headline" value="<?php echo __($headline, 'my-coupons') ?>"> </td>
                    </tr>
                    <tr>
                        <th>Coupon</th>
                        <td> <input type="text" placeholder="Coupon Code" name="couponcode" value="<?php echo __($coupon_code, 'my-coupons') ?>"> </td>
                    </tr>
                    <tr>
                        <th>Target URL</th>
                        <td> <input type="url" placeholder="Page link" name="pagelink" value="<?php echo __($target_url, 'my-coupons') ?>"> </td>
                    </tr>
                    <tr>
                        <th>Reviews</th>
                        <td> <input type="text" placeholder="Reviews" name="reviews" value="<?php echo __($reviews, 'my-coupons') ?>"> </td>
                    </tr>
                    <tr>
                        <th>Expires</th>
                        <td> <input type="date" placeholder="Expires" name="expires" value="<?php echo __($expires, 'my-coupons') ?>"> </td>
                    </tr>
                    <tr>
                        <th>Verified</th>
                        <td> <input type="date" placeholder="Expires" name="verified" value="<?php echo __($verified, 'my-coupons') ?>"> </td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td> 
                            <textarea placeholder="Leave blank if no need" name="description"><?php echo __($description, 'my-coupons') ?></textarea>
                            <input type="hidden" name="mcid" value="<?php echo $mcid; ?>">  
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <div id="templatecss">
                <table id="templatecssform">
                    <tbody>
                        <tr>
                            <th>Primary Color</th>
                            <td>
                                <input type="color" name="primarycolor" value="<?php echo $primarycolor; ?>"> 
                            </td>
                        </tr>
                        <tr>
                            <th>Secondary Color</th>
                            <td>
                                <input type="color" name="secondarycolor" value="<?php echo $secondarycolor; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>Text Colors</th>
                            <td> 
                                <input type="color" name="textscolors" value="<?php echo $textscolors; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>Description Color</th>
                            <td> 
                                <input type="color" name="descriptioncolor" value="<?php echo $descriptioncolor; ?>">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <button data-id="<?php echo (isset($_GET['mc'])? intval($_GET['mc']):''); ?>" class="restcolor">Reset</button>
            </div>
        </div>
        <button name="<?php echo (isset($_GET['mc'])? 'update':'published'); ?>" class="published button-primary">Publish</button>
    </form>
</div>