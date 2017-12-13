<?php 
/*
Plugin Name: EP Shop
Description: Create shop functionality
Version: 1.0
*/

require 'ep-shop-customers.php';
require 'C:/xampp/htdocs/Example/wp-config.php';
global $wpdb;

$sql = " CREATE TABLE  IF NOT EXISTS `example`.`wp_customers_ip`
( 
`ID` INT NOT NULL AUTO_INCREMENT ,
 `cust_ip` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
 `cust_discount` INT NOT NULL , 
 `cust_page_num` INT NOT NULL , 
 PRIMARY KEY (`ID`)
 ) 
 ENGINE = InnoDB";
$wpdb->query($sql);

function create_postype_products() {
    register_post_type( 'products',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Products' ),
                'singular_name' => __( 'Product' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'products'),
			'menu_icon' => 'dashicons-cart',
        )
    );
}

function menu_customers() {
	add_menu_page('Customers', 'Customers', 'manage_options', 'my-top-level-handle', 'customers_list_page', 'dashicons-groups');
}

function custom_post_type() {
 // Set UI labels for Products Post Type
    $labels = array(
        'name'                => _x( 'Products', 'Post Type General Name', 'twentythirteen' ),
        'singular_name'       => _x( 'Products', 'Post Type Singular Name', 'twentythirteen' ),
        'menu_name'           => __( 'Products', 'twentythirteen' ),
        'parent_item_colon'   => __( 'Parent Product', 'twentythirteen' ),
        'all_items'           => __( 'All Products', 'twentythirteen' ),
        'view_item'           => __( 'View Product', 'twentythirteen' ),
        'add_new_item'        => __( 'Add New Product', 'twentythirteen' ),
        'add_new'             => __( 'Add New', 'twentythirteen' ),
        'edit_item'           => __( 'Edit Product', 'twentythirteen' ),
        'update_item'         => __( 'Update Product', 'twentythirteen' ),
        'search_items'        => __( 'Search Product', 'twentythirteen' ),
        'not_found'           => __( 'Not Found', 'twentythirteen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
    );
     
	// Set other options for Products Post Type
    $args = array(
        'label'               => __( 'products', 'twentythirteen' ),
        'description'         => __( 'Catalog products', 'twentythirteen' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'comments' ),
        'taxonomies'          => array( 'genres' ), 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
		'register_meta_box_cb' => 'add_your_fields_meta_box'
    );
     
    // Registering Products Post Type
    register_post_type( 'products', $args );
 
}
 
function add_my_post_types_to_query( $query ) {
    if ( is_home() && $query->is_main_query() )
        $query->set( 'post_type', array( 'post', 'products' ) );
    return $query;
}

function add_your_fields_meta_box() {
	add_meta_box(
		'your_fields_meta_box', // id
		'Your Fields', // title
		'custom_meta_box_callback', // callback
		'products', // screen
		'normal', // context
		'high' // priority
	);
		
	global $post;  
	$meta = get_post_meta( $post->ID, 'your_fields', true ); 
}


function custom_meta_box_callback() {
    global $post; // The WordPress post
    $values = get_post_custom( $post->ID );
    $text = isset( $values['price-field'] ) ? $values['price-field'] : '';
     
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <p>
        <label for="price-field">Price: </label>
        <input type="text" name="price-field" id="price-field" value="<?php echo $text[0]; ?>" />
    </p>

    <?php    
}


function custom_box_save( $post_id )
{
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
     
    if( !current_user_can( 'edit_post' ) ) return;
     
    $allowed = array( 
        'a' => array( 
            'href' => array() 
        )
    );
     
    if( isset( $_POST['price_field'] ) )
        update_post_meta( $post_id, 'price_field', wp_kses( $_POST['price_field'], $allowed ) ); // Saving data
}

function plugin_styles() {
	wp_enqueue_style( 'style-name', '/wp-content/plugins/ep-shop/assets/css/ep-shop.css' );
}

add_action( 'init', 'create_postype_products' );
add_action('admin_menu', 'menu_customers');
add_action( 'init', 'custom_post_type', 0 );
add_action( 'pre_get_posts', 'add_my_post_types_to_query' );
add_action( 'wp_enqueue_scripts', 'plugin_styles' );
add_action( 'save_post',  'custom_box_save');

