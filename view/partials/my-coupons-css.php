<?php
 $styles = json_decode($coupon->styles,true);
 // Added colors into veriables
 $primarycolor = $styles['primarycolor'];
 $secondarycolor = $styles['secondarycolor'];
 $description = $styles['descriptioncolor'];
 $textscolors = $styles['textscolors'];
?>
<style>
    :root{
        --primarycolor: <?php 
            if(!empty($primarycolor)){
                echo $primarycolor;
            }else{
                echo '#bfa970';
            }
        ?>;
        --secondarycolor: <?php 
            if(!empty($secondarycolor)){
                echo $secondarycolor;
            }else{
                echo '#231f20';
            }
        ?>;

        --description: <?php 
            if(!empty($description)){
                echo $description;
            }else{
                echo '#ababab';
            }
        ?>;
        --textscolors: <?php 
            if(!empty($textscolors)){
                echo $textscolors;
            }else{
                echo '#ffffff';
            }
        ?>;
    }
</style>