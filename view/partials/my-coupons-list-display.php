<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    My_Coupons
 * @subpackage My_Coupons/admin/partials
 */

wp_enqueue_style(  'my-coupons' );

if(isset($_POST['delete'])){
    $mcid = intval($_POST['mcid']);
    global $wpdb;
    $wpdb->query("DELETE FROM {$wpdb->prefix}mycoupon_lists WHERE ID = $mcid");
}
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<h1 class="title">Coupon Lists</h1>
<hr>

<div id="templateLists">
    <table id="templateListstable">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Shortcode</th>
                <th class="deletebtns">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            global $wpdb;
            $coupons = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}mycoupon_lists");
            if($coupons){
                $i = 1;
                foreach($coupons as $coupon){
                    echo '<tr>';
                    echo '<td>'.$i.'</td>';
                    echo '<td>'.$coupon->title.'</td>';
                    echo '<td><input class="cshortcode" type="text" readonly value="[mycoupon mc=\''.$coupon->ID.'\']"></td>';
                    echo '<td class="deletebtns">';
                    echo '<button class="edit"><a href="'.menu_page_url("add-new-coupon", false).'&mc='.$coupon->ID.'">Edit</a> </button>';
                    echo '<form action="" method="post">';
                    echo '<input type="hidden" value="'.$coupon->ID.'" name="mcid">';
                    echo '<button name="delete" class="delete">Delete</button>';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                    $i++;
                }
            }
            ?>
        </tbody>
    </table>
</div>
