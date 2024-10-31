<?php 


function ndtrck_ntp_echo_portfolio_settings($post)
{
	$nt_portfolio_set_primarycolor = get_post_meta( $post->ID, 'nt-portfolio-set-primarycolor', true);
    $nt_portfolio_set_secondarycolor = get_post_meta( $post->ID, 'nt-portfolio-set-secondarycolor', true);
    $nt_portfolio_set_autoplay = get_post_meta( $post->ID, 'nt-portfolio-set-autoplay', true);
    $nt_portfolio_set_sliderskin = get_post_meta( $post->ID, 'nt-portfolio-set-sliderskin', true);
    $nt_portfolio_set_effect = get_post_meta( $post->ID, 'nt-portfolio-set-effect', true);
    $nt_portfolio_set_pauseonhover = get_post_meta( $post->ID, 'nt-portfolio-set-pauseonhover', true);
    $nt_portfolio_set_navigation = get_post_meta( $post->ID, 'nt-portfolio-set-navigation', true);
    $nt_portfolio_set_pagination = get_post_meta( $post->ID, 'nt-portfolio-set-pagination', true);
    $nt_portfolio_set_thumbnails = get_post_meta( $post->ID, 'nt-portfolio-set-thumbnails', true);
    $nt_portfolio_set_slideduration = get_post_meta( $post->ID, 'nt-portfolio-set-slideduration', true);
    $nt_portfolio_set_transduration = get_post_meta( $post->ID, 'nt-portfolio-set-transduration', true);
    $nt_portfolio_set_sliderheight = get_post_meta( $post->ID, 'nt-portfolio-set-sliderheight', true);


	?>
    <div>
    <p><span style="font-weight: 700">Tile settings for listing: </span></p>

    <p><span>Secondary color: </span><input class="nt-portfolio-settings color-picker" name="nt-portfolio-set-secondarycolor" data-alpha="true" value="<?php echo $nt_portfolio_set_secondarycolor ?>"/></p>
</div>
<div style="background-color: black;height:1px"></div>
<div>
    <p><span style="font-weight: 700">Slider Settings for single item:</span></p>
    

    <p><span>Slider Height: </span> <input class="nt-portfolio-settings" name="nt-portfolio-set-sliderheight" type="number" min="0" max="100" value="<?php if(!empty($nt_portfolio_set_sliderheight)){echo $nt_portfolio_set_sliderheight;} ?>"/>%</p>
    
    <p><span>Pause on hover: </span> <input class="nt-portfolio-settings" name="nt-portfolio-set-pauseonhover" type="checkbox" <?php if(!empty($nt_portfolio_set_pauseonhover)){echo "checked";} ?> /></p>
    
    <p><span>Navigation: </span> <input class="nt-portfolio-settings" name="nt-portfolio-set-navigation" type="checkbox" <?php if(!empty($nt_portfolio_set_navigation)){echo "checked";} ?>/></p>


    <p><span>Slide Duration (ms): </span> <input class="nt-portfolio-settings" name="nt-portfolio-set-slideduration" type="number" min="0" value="<?php if(!empty($nt_portfolio_set_slideduration)){echo $nt_portfolio_set_slideduration;} ?>"/></p>
    
    <p><span>Transition Duration: </span> <input class="nt-portfolio-settings" name="nt-portfolio-set-transduration" type="number" min="0" value="<?php if(!empty($nt_portfolio_set_transduration)){echo $nt_portfolio_set_transduration;} ?>"/></p>
</div>
	<?php
}

function ndtrck_ntp_save_portfolio_meta($post_id)
{
	 if(get_post_type($post_id)!="nt_portfolio")
        return;

     delete_post_meta($post_id, 'nt-portfolio-image');

    if(array_key_exists('nt-portfolio-image', $_POST))
    {
        $filtered = array_map("absint", $_POST['nt-portfolio-image']);
        foreach ($filtered as $value) {
            if(!is_null($value) && $value != 0)
                add_post_meta($post_id, 'nt-portfolio-image', $value);
        }
    }

    delete_post_meta($post_id, 'nt-portfolio-link');
    if(array_key_exists('nt-portfolio-link', $_POST))
    {
        add_post_meta($post_id, 'nt-portfolio-link',esc_url_raw(  $_POST['nt-portfolio-link'] ),  true);
    }

    delete_post_meta($post_id, 'nt-portfolio-linktext');
    if(array_key_exists('nt-portfolio-linktext', $_POST))
    {
        add_post_meta($post_id, 'nt-portfolio-linktext', sanitize_text_field($_POST['nt-portfolio-linktext']),  true);
    }

    delete_post_meta($post_id, 'nt-portfolio-subtitle');
    if(array_key_exists('nt-portfolio-subtitle', $_POST))
    {
        add_post_meta($post_id, 'nt-portfolio-subtitle', sanitize_text_field($_POST['nt-portfolio-subtitle']),  true);
    }


    delete_post_meta($post_id, 'nt-portfolio-set-secondarycolor');
    if(array_key_exists('nt-portfolio-set-secondarycolor',$_POST))
    {
        add_post_meta($post_id, 'nt-portfolio-set-secondarycolor', sanitize_text_field($_POST['nt-portfolio-set-secondarycolor']), true);
    }



    delete_post_meta($post_id, 'nt-portfolio-set-pauseonhover');
    if(array_key_exists('nt-portfolio-set-pauseonhover',$_POST))
    {
        add_post_meta($post_id, 'nt-portfolio-set-pauseonhover', sanitize_text_field($_POST['nt-portfolio-set-pauseonhover']), true);
    }


    delete_post_meta($post_id, 'nt-portfolio-set-navigation');
    if(array_key_exists('nt-portfolio-set-navigation',$_POST))
    {
        add_post_meta($post_id, 'nt-portfolio-set-navigation', sanitize_text_field($_POST['nt-portfolio-set-navigation']), true);
    }


    delete_post_meta($post_id, 'nt-portfolio-set-slideduration');
    if(array_key_exists('nt-portfolio-set-slideduration',$_POST))
    {
        add_post_meta($post_id, 'nt-portfolio-set-slideduration', absint($_POST['nt-portfolio-set-slideduration']), true);
    }

    delete_post_meta($post_id, 'nt-portfolio-set-transduration');
    if(array_key_exists('nt-portfolio-set-transduration',$_POST))
    {
        add_post_meta($post_id, 'nt-portfolio-set-transduration',  absint($_POST['nt-portfolio-set-transduration']), true);
    }

    delete_post_meta($post_id, 'nt-portfolio-set-sliderheight');
    if(array_key_exists('nt-portfolio-set-sliderheight',$_POST) )
    {
        add_post_meta($post_id, 'nt-portfolio-set-sliderheight', floatval($_POST['nt-portfolio-set-sliderheight']), true);
    }


}


function ndtrck_ntp_get_portfolio_options($post)
{
    $nt_portfolio_set_pauseonhover = get_post_meta( $post->ID, 'nt-portfolio-set-pauseonhover', true);
    
    $nt_portfolio_set_navigation = get_post_meta( $post->ID, 'nt-portfolio-set-navigation', true);
    $nt_portfolio_set_pagination = get_post_meta( $post->ID, 'nt-portfolio-set-pagination', true);
    $nt_portfolio_set_slideduration = get_post_meta( $post->ID, 'nt-portfolio-set-slideduration', true);
    $nt_portfolio_set_transduration = get_post_meta( $post->ID, 'nt-portfolio-set-transduration', true);
    $nt_portfolio_set_sliderheight = get_post_meta( $post->ID, 'nt-portfolio-set-sliderheight', true);

    $options = array("fx"=> "scrollLeft", 
        "hover"=>!empty($nt_portfolio_set_pauseonhover)? true : false, 
        "autoAdvance"=> true,
        "mobileAutoAdvance" => true,
        "navigation"=>!empty($nt_portfolio_set_navigation)? true : false, 
        "playPause" =>!empty($nt_portfolio_set_navigation)? true : false,
        "pagination"=> false, 
        "thumbnails"=> false, 
        "time" => $nt_portfolio_set_slideduration,
        "transPeriod" => $nt_portfolio_set_transduration,
        "height"=> $nt_portfolio_set_sliderheight."%",
        "loader"=>"none",
        "sliderSkin" => "");

    return $options;
}

?>