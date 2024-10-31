<?php

add_action( 'init', 'ndtrck_ntp_register_nt_portfolio' );

function ndtrck_ntp_register_nt_portfolio() {
    register_post_type( 'nt_portfolio',
        array(
            'labels' => array(
                'name' => 'NT Portfolio',
                'singular_name' => 'Portfolio Item',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Portfolio Item',
                'edit' => 'Edit',
                'edit_item' => 'Edit Portfolio Item',
                'new_item' => 'New Portfolio Item',
                'view' => 'View',
                'view_item' => 'View Portfolio Item',
                'search_items' => 'Search Portfolio Items',
                'not_found' => 'No Portfolio Items found',
                'not_found_in_trash' => 'No Portfolio Items found in Trash',
                'parent' => 'Parent Portfolio Item'
            ),
 
            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'taxonomies' => array( '' ),
            'menu_icon' => plugins_url( 'images/plugin.png',  dirname(__FILE__) ),
            'has_archive' => false,
            'publicly_queryable'  => false
        )
    );
}

add_action( 'init', 'ndtrck_ntp_remove_comments' );

function ndtrck_ntp_remove_comments() {
    remove_post_type_support( 'nt_portfolio', 'comments' );
}

//------------------------- custom columns --------------------------------------------

add_filter( 'manage_posts_columns', 'ndtrck_ntp_set_custom_edit_columns' );
add_action( 'manage_posts_custom_column' , 'ndtrck_ntp_custom_column', 10, 2 );

function ndtrck_ntp_set_custom_edit_columns($columns) {
    $columns['id'] = "ID";

    return $columns;
}

function ndtrck_ntp_custom_column( $column, $post_id ) {
    switch ( $column ) {

        case 'id' :
            echo $post_id; 
            break;

    }
}
//------------------------- images metabox --------------------------------------------
function ndtrck_ntp_images_metabox() {

    add_meta_box(
        'portfolio-image',
        'Portfolio images',
        'ndtrck_ntp_images_metabox_callback',
        'nt_portfolio',
        'side'
    );
}



function ndtrck_ntp_images_metabox_callback()
{
    wp_enqueue_media();
    wp_enqueue_script('ntPortfolio',plugins_url( 'js/ntPortfolioAdmin.js', dirname(__FILE__) ));
        global $post;

    // Get WordPress' media upload URL
    $upload_link = esc_url( get_upload_iframe_src( 'image', $post->ID ) );

    // See if there's a media id already saved as post meta
    $your_img_ids = get_post_meta( $post->ID, 'nt-portfolio-image' ); //array

    // Get the image src
    $your_img_srcs = array();
    foreach ($your_img_ids as $row) {
        array_push($your_img_srcs, wp_get_attachment_image_src( $row, 'full' ));
    }

    $you_have_img = !empty( $your_img_ids );
    ?>

    <!-- Your image container, which can be manipulated with js -->
    <div class="custom-img-container">
        <?php if ( $you_have_img ) : 
            $counter=0;
            foreach ($your_img_srcs as $key) : ?>
                <img src="<?php echo $key[0] ?>" alt="" style="max-width:100%;" />
                <a class="delete-single-img" data-id="<?php echo $your_img_ids[$counter]; ?>" data-src="<?php echo $key[0]; ?>"
                    href="#">
                    <?php _e('Remove image') ?>
                </a>
                <?php $counter++; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Your add & remove image links -->
    <p class="hide-if-no-js">
        <a class="upload-custom-img" 
           href="<?php echo $upload_link ?>">
            <?php _e('Add portfolio images') ?>
        </a>
    </p>

    <!-- A hidden input to set and post the chosen image id -->

    <?php if ( $you_have_img ) : 
            foreach ($your_img_ids as $key) : ?>
                <input class="nt-portfolio-image" name="nt-portfolio-image[]" type="hidden" value="<?php echo esc_attr( $key ); ?>" /> 
            <?php endforeach; ?>
        <?php endif; ?>
    
    <?php
}

// ----------------------- link metabox --------------------------------
function ndtrck_ntp_link_metabox() {

    add_meta_box(
        'portfolio-link',
        'Portfolio link',
        'ndtrck_ntp_link_metabox_callback',
        'nt_portfolio',
        'side'
    );
}

function ndtrck_ntp_link_metabox_callback()
{
    global $post;
    $link =  get_post_meta( $post->ID, 'nt-portfolio-link', true);
    $linktext =  get_post_meta( $post->ID, 'nt-portfolio-linktext', true);
    
?>


<input style="width:100%" class="nt-portfolio-link" placeholder="link" name="nt-portfolio-link" type="url" value="<?php echo $link ?>" /> 
<input style="width:100%" class="nt-portfolio-linktext" placeholder="link text" name="nt-portfolio-linktext" type="text" value="<?php echo $linktext ?>" /> 
<?php
}

//------------------ subtitle metabox ----------------------
function ndtrck_ntp_subtitle_metabox() {

    add_meta_box(
        'portfolio-subtitle',
        'Portfolio Subtitle',
        'ndtrck_ntp_subtitle_metabox_callback',
        'nt_portfolio'
    );
}

function ndtrck_ntp_subtitle_metabox_callback()
{
    global $post;
    $subtitle =  get_post_meta( $post->ID, 'nt-portfolio-subtitle', true);
    //echo "link: "
?>


<input style="width:100%;" class="nt-portfolio-subtitle" name="nt-portfolio-subtitle" type="text-area" value="<?php echo $subtitle ?>" /> 
<?php
}



//------------------------- settings metabox ------------------------

function ndtrck_ntp_settings_metabox() {

    add_meta_box(
        'portfolio-settings',
        'NT Portfolio settings',
        'ndtrck_ntp_settings_metabox_callback',
        'nt_portfolio'
    );
}

function ndtrck_ntp_settings_metabox_callback()
{
    global $post;
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker-alpha', plugins_url( 'js/wp-color-picker-alpha.js', dirname(__FILE__) ), array( 'wp-color-picker' ), '1.2.2', true );


    ndtrck_ntp_echo_portfolio_settings($post);
}


//------------------------- add metaboxes -----------------------------
add_action( 'add_meta_boxes', 'ndtrck_ntp_settings_metabox' );
add_action( 'add_meta_boxes', 'ndtrck_ntp_subtitle_metabox' );
add_action( 'add_meta_boxes', 'ndtrck_ntp_images_metabox' );
add_action( 'add_meta_boxes', 'ndtrck_ntp_link_metabox' );

//------------------------- save metadata -----------------------------
function ndtrck_ntp_save_metadata($post_id)
{
   ndtrck_ntp_save_portfolio_meta($post_id);
}
add_action('save_post', 'ndtrck_ntp_save_metadata');

