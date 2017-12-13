<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'specia' ); ?></a>

<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="custom-header" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
<?php endif;  ?>	

<?php get_template_part('sections/specia','header'); ?>

<?php get_template_part('sections/specia','navigation'); ?>

<script>
			$( document ).ready(function() {
				if (readCookie('preferredMember') >= 1) {
					var ca = document.cookie.split('=');
					ca = parseInt(readCookie('preferredMember'))+1;
					createCookie('preferredMember', parseInt(ca));
					$.getJSON('//api.ipify.org?format=jsonp&callback=?', function(data) {
						var customerIp = data;
						createCookie('customerIp', customerIp.ip+'');
					});
				} else {
					if(readCookie('customerCard') == 0 || readCookie('customerCard') == null) {
						createCookie('customerCard', 0);
					} 
					createCookie('preferredMember', 2);
					$.getJSON('//api.ipify.org?format=jsonp&callback=?', function(data) {
						var customerIp = data;
						createCookie('customerIp', customerIp.ip+'');
					});
					$(".discount b").text("0");
				}
			
				function createCookie(name, value, days) {
				  var expires = "";
				  document.cookie = name + "=" + value + expires + "; path=/";
				}

				function readCookie(name) {
				  var nameEQ = name + "=";
				  var ca = document.cookie.split(';');
				  for (var i = 0; i < ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0) == ' ') c = c.substring(1, c.length);
					if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
				  }
				  return null;
				}
				
				$(".products-num b").text(""+readCookie('customerCard'));
				$(".add-to-cart").click(function() {
					var ca = parseInt(readCookie('customerCard'))+1;
					createCookie('customerCard', ca);
					$(".products-num b").text(""+readCookie('customerCard'));
					if(readCookie('customerCard') > 1) {
						createCookie('preferredMember', 2);
						$(".discount b").text("0");
					}
				});
			});
			</script>
			
			<?php 
				if($_COOKIE[preferredMember] >= 1) {
					$customer_ip = $wpdb->get_results(
						"
						SELECT *
						FROM wp_customers_ip
						WHERE cust_ip='$_COOKIE[customerIp]'
					");
					if($customer_ip) {
						$discount;
						if($_COOKIE[preferredMember] >= 10) {
							if($customer_ip[0]->cust_discount != 0 && $customer_ip[0]->cust_discount != null) {
								$discount = $customer_ip[0]->cust_discount;
							} else {
								$discount = 10;
							}
						} else {
							$discount = 0;
						}
						$sql = "UPDATE `wp_customers_ip`
						SET cust_page_num=$_COOKIE[preferredMember], cust_discount=$discount
						WHERE cust_ip='$_COOKIE[customerIp]'";
						$wpdb->query($sql);
					} else {
						$sql = "INSERT INTO `wp_customers_ip`
							  (`cust_ip`,`cust_discount`,`cust_page_num`) 
					   values ('$_COOKIE[customerIp]', 0, $_COOKIE[preferredMember])";
						$wpdb->query($sql);
					}
				} else {
					$sql = "UPDATE `wp_customers_ip`
						SET cust_discount=0
						WHERE cust_ip='$_COOKIE[customerIp]'";
						$wpdb->query($sql);
				}
			?>
	<div id="content" class="site-content" role="main">