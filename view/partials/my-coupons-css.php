<?php
 $styles = json_decode($coupon->styles,true);
 // Added colors into veriables
 $primarycolor = $styles['primarycolor'];
 $secondarycolor = $styles['secondarycolor'];
 $playbtnbg = $styles['playbtnbg'];
 $textscolors = $styles['textscolors'];
?>
<style>
    :root{
        --primarycolor: <?php 
            if(!empty($primarycolor)){
                echo $primarycolor;
            }else{
                echo '#a39145';
            }
        ?>;
        --secondarycolor: <?php 
            if(!empty($secondarycolor)){
                echo $secondarycolor;
            }else{
                echo '#ffffff';
            }
        ?>;

        --playbtnbg: <?php 
            if(!empty($playbtnbg)){
                echo $playbtnbg;
            }else{
                echo '#74be41';
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