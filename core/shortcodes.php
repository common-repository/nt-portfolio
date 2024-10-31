<?php

// [bartag foo="foo-value"]
function ndtrck_ntp_tiles_shortcode( $atts ) {
    $attributes = shortcode_atts( array(
        'id' => 'all',
        'layout' => 'standard',
        'columns' => "4",
    ), $atts );

    //  echo "test: ".$attributes['id']." ".$attributes['layout']." ".$attributes["columns"];

    // echo ($attributes["columns"]=="3");
    $portfolioPosts = ndtrck_ntp_get_portfolio_posts($attributes['id']);
    ndtrck_ntp_output_portfolio_items($portfolioPosts, $attributes['layout'],$attributes["columns"]);

}

add_shortcode( 'ntportfolio', 'ndtrck_ntp_tiles_shortcode' );

function ndtrck_ntp_single_shortcode( $atts ) {
    $attributes = shortcode_atts( array(
        'id' => 'all',
        'layout' => 'standard',
        'columns' => "4",
    ), $atts );

    if(is_numeric($attributes['id']))
    	$portfolioSingle = ndtrck_ntp_get_portfolio_posts($attributes['id']);
    else
    	return;

    ndtrck_ntp_output_single_item($portfolioSingle, $attributes['layout']);

}

add_shortcode( 'ntportfolio_single', 'ndtrck_ntp_single_shortcode' );

function ndtrck_ntp_get_portfolio_posts($id)
{

	if($id=="all")
	{
		$queryArgs = array(
	  		'post_type'   => 'nt_portfolio'
		);
	}
	else
	{
		$postIds = explode(",", $id);
		$queryArgs = array(
	  		'post_type'   => 'nt_portfolio',
	  		'post__in' => $postIds
		);
	}
	
	return get_posts($queryArgs);
	//var_dump($portfolioItems);
}

function ndtrck_ntp_output_portfolio_items($posts,$layout, $columns)
{
	wp_enqueue_style("ntStyle", plugins_url( 'css/ntportfolio.css', dirname(__FILE__) ));
	if($layout=="standard" || $layout=="glass")
		echo ndtrck_ntp_ouput_layout_glass($posts,$layout, $columns);
	elseif($layout=="centblack")
		echo ndtrck_ntp_ouput_layout_centblack($posts,$layout, $columns);
	elseif($layout=="vertblack")
		echo ndtrck_ntp_ouput_layout_vertblack($posts,$layout, $columns);
	elseif($layout=="kinetic")
		echo ndtrck_ntp_ouput_layout_kinetic($posts,$layout, $columns);
}

function ndtrck_ntp_ouput_layout_kinetic($posts,$layout, $columns){


	$outputHtml = "<div>";

	$widthClass = "col-4";

	if($columns=="4" || $columns=="3" || $columns =="2")
		$widthClass= "col-".$columns;

	foreach ($posts as $post) {
		$link =  get_post_meta( $post->ID, 'nt-portfolio-link', true);
		$linktext = get_post_meta( $post->ID, 'nt-portfolio-linktext', true);
		$subtitle = get_post_meta( $post->ID, 'nt-portfolio-subtitle', true);
		$nt_portfolio_set_primarycolor = get_post_meta( $post->ID, 'nt-portfolio-set-primarycolor', true);
    	$nt_portfolio_set_secondarycolor = get_post_meta( $post->ID, 'nt-portfolio-set-secondarycolor', true);

		if($link!="")
			$outputHtml .= '<a href="'.$link.'" class="'.$widthClass.'">';
		else
			$outputHtml .= '<div class="'.$widthClass.'">';


		$outputHtml .= '<div class="empty-bg" style="background-color:'.$nt_portfolio_set_primarycolor.';">';
		$outputHtml .= '<div class="header-container-kinetic">';
		$outputHtml .= '<h3 class="sliding-header" style="color:'.$nt_portfolio_set_secondarycolor.';">'.$post->post_title.'</h3>';
		$outputHtml .= '<span class="sliding-sp" style="color:'.$nt_portfolio_set_secondarycolor.';">'.$subtitle.'</span>';
		$outputHtml .= '</div>';
		$outputHtml .= '<span class="more-text-kinetic" style="color:'.$nt_portfolio_set_secondarycolor.';">'.$linktext.'</span>';	
		$outputHtml .= '<div class="image-foreground" style="background-image: url('.wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "medium")[0].')">';
		$outputHtml .= '</div>';
		$outputHtml .= '</div>';

		if($link!="")
			$outputHtml .= '</a>';
		else
			$outputHtml .= '</div>';
	}

	$outputHtml .= "</div>";
	return $outputHtml;
}

function ndtrck_ntp_ouput_layout_vertblack($posts,$layout, $columns){
	
    
	$outputHtml = "<div>";

	$widthClass = "col-4";

	if($columns=="4" || $columns=="3" || $columns =="2")
		$widthClass= "col-".$columns;

	foreach ($posts as $post) {
		$link =  get_post_meta( $post->ID, 'nt-portfolio-link', true);
		$linktext = get_post_meta( $post->ID, 'nt-portfolio-linktext', true);
		$subtitle = get_post_meta( $post->ID, 'nt-portfolio-subtitle', true);
		$nt_portfolio_set_primarycolor = get_post_meta( $post->ID, 'nt-portfolio-set-primarycolor', true);
    	$nt_portfolio_set_secondarycolor = get_post_meta( $post->ID, 'nt-portfolio-set-secondarycolor', true);

		if($link!="")
			$outputHtml .= '<a href="'.$link.'" class="'.$widthClass.'">';
		else
			$outputHtml .= '<div class="'.$widthClass.'">';
		
		$outputHtml .= '<div class="image-background-clear" style="background-image: url('.wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "medium")[0].')">';
		$outputHtml .= '<div class="fade-area" style="background-color:'.$nt_portfolio_set_primarycolor.';">';
		$outputHtml .= '<div class="header-container-vertblack">';
		$outputHtml .= '<h3 class="moving-header" style="color:'.$nt_portfolio_set_secondarycolor.';">'.$post->post_title.'</h3>';
		$outputHtml .= '<span class="moving-sp" style="color:'.$nt_portfolio_set_secondarycolor.';">'.$subtitle.'</span>';
		$outputHtml .= '</div>';	
			$outputHtml .= '<span class="more-text-centblack" style="color:'.$nt_portfolio_set_secondarycolor.';">'.$linktext.'</span>';	
		$outputHtml .= '</div>';
		$outputHtml .= '</div>';
		
		if($link!="")
			$outputHtml .= '</a>';
		else
			$outputHtml .= '</div>';
	}

	$outputHtml .= "</div>";
	return $outputHtml;
}

function ndtrck_ntp_ouput_layout_centblack($posts,$layout, $columns){
	
    
	$outputHtml = "<div>";

	$widthClass = "col-4";

	if($columns=="4" || $columns=="3" || $columns =="2")
		$widthClass= "col-".$columns;

	foreach ($posts as $post) {
		$link =  get_post_meta( $post->ID, 'nt-portfolio-link', true);
		$linktext = get_post_meta( $post->ID, 'nt-portfolio-linktext', true);
		$subtitle = get_post_meta( $post->ID, 'nt-portfolio-subtitle', true);
		$nt_portfolio_set_primarycolor = get_post_meta( $post->ID, 'nt-portfolio-set-primarycolor', true);
    	$nt_portfolio_set_secondarycolor = get_post_meta( $post->ID, 'nt-portfolio-set-secondarycolor', true);

		if($link!="")
			$outputHtml .= '<a href="'.$link.'" class="'.$widthClass.'">';
		else
			$outputHtml .= '<div class="'.$widthClass.'">';
		
		$outputHtml .= '<div class="image-background-clear" style="background-image: url('.wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "medium")[0].')">';
		$outputHtml .= '<div class="expand-area" style="background-color:'.$nt_portfolio_set_primarycolor.';">';
		$outputHtml .= '<div class="header-container-centblack">';
		$outputHtml .= '<h3 class="black-header" style="color:'.$nt_portfolio_set_secondarycolor.';">'.$post->post_title.'</h3>';
		$outputHtml .= '<span class="black-sp" style="color:'.$nt_portfolio_set_secondarycolor.';">'.$subtitle.'</span>';
		$outputHtml .= '</div>';	
		$outputHtml .= '<span class="more-text-centblack" style="color:'.$nt_portfolio_set_secondarycolor.';">'.$linktext.'</span>';	
		$outputHtml .= '</div>';
		$outputHtml .= '</div>';
		
		if($link!="")
			$outputHtml .= '</a>';
		else
			$outputHtml .= '</div>';
	}

	$outputHtml .= "</div>";
	return $outputHtml;
}

function ndtrck_ntp_ouput_layout_glass($posts,$layout, $columns)
{
	
    
	$outputHtml = "<div>";

	$widthClass = "col-4";

	if($columns=="4" || $columns=="3" || $columns =="2")
		$widthClass= "col-".$columns;

	foreach ($posts as $post) {
		$link =  get_post_meta( $post->ID, 'nt-portfolio-link', true);
		$linktext = get_post_meta( $post->ID, 'nt-portfolio-linktext', true);
		$subtitle = get_post_meta( $post->ID, 'nt-portfolio-subtitle', true);
		$nt_portfolio_set_primarycolor = get_post_meta( $post->ID, 'nt-portfolio-set-primarycolor', true);
    	$nt_portfolio_set_secondarycolor = get_post_meta( $post->ID, 'nt-portfolio-set-secondarycolor', true);

		if($link!="")
			$outputHtml .= '<a href="'.$link.'" class="'.$widthClass.'">';
		else
			$outputHtml .= '<div class="'.$widthClass.'">';
		
		$outputHtml .= '<div class="image-background" style="background-image: url('.wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "medium")[0].')">';
		$outputHtml .= '<div class="image-color" style="background-color:'.$nt_portfolio_set_primarycolor.';"></div>';
		$outputHtml .= '</div>';
		$outputHtml .= '<div class="header-container">';
		$outputHtml .= '<h3 class="white-header" style="color:'.$nt_portfolio_set_secondarycolor.';">'.$post->post_title.'</h3>';
		$outputHtml .= '<span class="border" style="border-color:'.$nt_portfolio_set_secondarycolor.';"></span>';
		$outputHtml .= '<h3 class="white-header" style="color:'.$nt_portfolio_set_secondarycolor.';">'.$subtitle.'</h3>';
		
		$outputHtml .= '</div>';
		$outputHtml .= '<span class="more-text" style="color:'.$nt_portfolio_set_secondarycolor.';">'.$linktext.'</span>';
		$outputHtml .= '<div class="image-effect" style="background-image: url('.wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "medium")[0].')">';
		

		$outputHtml .= '</div>';
		
		if($link!="")
			$outputHtml .= '</a>';
		else
			$outputHtml .= '</div>';
	}

	$outputHtml .= "</div>";
	return $outputHtml;
}

function ndtrck_ntp_output_single_item($posts, $layout)
{
	wp_enqueue_style("ntStyle", plugins_url( 'css/ntportfolio.css', dirname(__FILE__) ));
	wp_enqueue_script('camera',plugins_url( 'js/camera.min.js', dirname(__FILE__) ),array('jquery'));


	//wp_enqueue_script('singlePortfolio',plugins_url( 'js/singlePortfolio.js', dirname(__FILE__) ),array('jquery'));

	$postIds= array();

	wp_enqueue_style("camStyle", plugins_url( 'css/camera.css', dirname(__FILE__) )  );

	foreach ($posts as $post) {

		if($layout=="reversed")
			$outputHtml = '<div class="right-col-rev">';
		else
			$outputHtml = '<div class="right-col">';
		$outputHtml .= '<h2 style="margin-bottom: 10px;">'.$post->post_title.'</h2>';
		$outputHtml .= '<p>'.$post->post_content.'</p>';
		$outputHtml .= '</div>';
		if($layout=="reversed")
			$outputHtml .= '<div class="left-col-rev">';
		else
			$outputHtml .= '<div class="left-col">';
		$portfolioImages = get_post_meta($post->ID,'nt-portfolio-image');

		$allOptions = array();
		if(!empty($portfolioImages))
		{
			
			$options = ndtrck_ntp_get_portfolio_options($post);

			$customId = $post->ID.'-'.rand();
			$outputHtml .= '<div class="portfolio-slider '.$options["sliderSking"].'" id="'.$customId.'" style="height: 100%">';

			foreach ($portfolioImages as $id) {

				if(wp_get_attachment_image_src( $id, 'full' )[0]!="")
					$outputHtml .= '<div data-src="'.wp_get_attachment_image_src( $id, 'full' )[0].'" data-thumb="'.wp_get_attachment_image_src( $id, 'thumbnail' )[0].'"></div>';
			}
			$outputHtml .= '</div>';

			array_push($postIds, '#'.$customId);
			array_push($allOptions, $options);
		}

		$outputHtml .= '</div>';

		echo $outputHtml;

	}


	echo '<script>jQuery( document ).ready(function() {
		var postIds='.json_encode($postIds).'
		var allOptions='.json_encode($allOptions).'
		console.log(allOptions[0]);
		for(var i=0;i<postIds.length;i++){
			jQuery(postIds[i]).camera(allOptions[i]);
		}
	});</script>';
}