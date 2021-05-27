<?php
wp_enqueue_style(  'my-coupons' );
wp_enqueue_script(  'my-coupons' );

$mcid = '';
$title = '';
$logo = '';
$headline = '';
$couponheadline = '';
$subheadline = '';
$coupon_code = '';
$target_url = '';
$reviews = '';
$votes = '';
$description = '';
$styles = '';
// Colors

$primarycolor = '#a39145';
$secondarycolor = '#ffffff';
$textscolors = '#ffffff';
$playbtnbg = '#74be41';

if(isset($_POST['published']) || isset($_POST['update'])){
    if(isset($_POST['temptitle']) && !empty($_POST['temptitle']) && isset($_POST['couponcode']) && !empty($_POST['couponcode'])){
        
        global $wpdb;
        $couponstbl = $wpdb->prefix.'mycoupon_lists_v3';

        $post_title = sanitize_text_field(stripslashes($_POST['temptitle']));
        $post_logo = sanitize_text_field($_POST['clogo']);
        $post_headline = sanitize_text_field(stripslashes($_POST['headline']));
        $couponheadline = sanitize_text_field(stripslashes($_POST['couponheadline']));
        $subheadline = sanitize_text_field(stripslashes($_POST['subheadline']));
        $post_coupon_code = sanitize_text_field($_POST['couponcode']);
        $post_target_url = esc_url_raw($_POST['pagelink']);
        $post_reviews_txt = intval($_POST['reviews']);
        $post_votes_txt = intval($_POST['votes']);
        $post_description = sanitize_text_field(stripslashes($_POST['description']));
        $post_styles = array(
            'secondarycolor'      => isset($_POST['secondarycolor'])?$_POST['secondarycolor']:'',
            'textscolors'   => isset($_POST['textscolors'])?$_POST['textscolors']:'',
            'playbtnbg'   => isset($_POST['playbtnbg'])?$_POST['playbtnbg']:'',
            'primarycolor'       => isset($_POST['primarycolor'])?$_POST['primarycolor']:''
        );

        if(isset($_POST['mcid']) && !empty($_POST['mcid'])){
            $results = $wpdb->get_var("SELECT ID FROM {$wpdb->prefix}mycoupon_lists_v3 WHERE ID = {$_POST['mcid']}");

            if($results){
                $wpdb->update($couponstbl, array(
                    'title' => $post_title,
                    'logo' => $post_logo,
                    'headline' => $post_headline,
                    'couponheadline' => $couponheadline,
                    'subheadline' => $subheadline,
                    'coupon_code' => $post_coupon_code,
                    'target_url' => $post_target_url,
                    'reviews' => $post_reviews_txt,
                    'votes' => $post_votes_txt,
                    'description' => $post_description,
                    'styles' => json_encode($post_styles),
                ),array(
                    'ID' => $_POST['mcid']
                ),array(
                    '%s','%s','%s','%s','%s','%s','%s','%d','%d','%s','%s'
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
                'couponheadline' => $couponheadline,
                'subheadline' => $subheadline,
                'coupon_code' => $post_coupon_code,
                'target_url' => $post_target_url,
                'reviews' => $post_reviews_txt,
                'votes' => $post_votes_txt,
                'description' => $post_description,
                'styles' => json_encode($post_styles),
            ),array(
                '%s','%s','%s','%s','%s','%s','%s','%d','%d','%s','%s'
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
    $coupon = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}mycoupon_lists_v3 WHERE ID = $mcid");
    if(!empty($coupon) && !is_wp_error( $coupon )){
        $title = $coupon->title;
        $logo = $coupon->logo;
        $headline = $coupon->headline;
        $couponheadline = $coupon->couponheadline;
        $subheadline = $coupon->subheadline;
        $coupon_code = $coupon->coupon_code;
        $target_url = $coupon->target_url;
        $reviews = $coupon->reviews;
        $votes = $coupon->votes;
        $description = $coupon->description;
        $styles = json_decode($coupon->styles,true);
    }

    // Added colors into veriables
    $secondarycolor = (!empty($styles['secondarycolor'])?$styles['secondarycolor']: $secondarycolor);
    $textscolors = (!empty($styles['textscolors'])?$styles['textscolors']: $textscolors);
    $playbtnbg = (!empty($styles['playbtnbg'])?$styles['playbtnbg']: $playbtnbg);
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
                        <th>Coupon Headline</th>
                        <td> <input type="text" placeholder="Couponheadline" name="couponheadline" value="<?php echo __($couponheadline, 'my-coupons') ?>"> </td>
                    </tr>
                    <tr>
                        <th>Sub Headline</th>
                        <td> <input type="text" placeholder="Subheadline" name="subheadline" value="<?php echo __($subheadline, 'my-coupons') ?>"> </td>
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
                        <td> <input type="number" placeholder="Reviews" name="reviews" value="<?php echo __($reviews, 'my-coupons') ?>"> </td>
                    </tr>
                    <tr>
                        <th>Votes</th>
                        <td> <input type="number" placeholder="Votes" name="votes" value="<?php echo __($votes, 'my-coupons') ?>"> </td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td> 
                            <input type="text"placeholder="Leave blank if no need" name="description" value="<?php echo __($description, 'my-coupons') ?>">
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
                            <th>Play button color</th>
                            <td> 
                                <input type="color" name="playbtnbg" value="<?php echo $playbtnbg; ?>">
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