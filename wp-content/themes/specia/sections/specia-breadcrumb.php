<section class="breadcrumb">
    <div class="background-overlay">
        <div class="container">
            <div class="row padding-top-10 padding-bottom-10">
                <div class="col-md-6 col-xs-12 col-sm-6">
				<?php 
				$customer_data = $wpdb->get_results(
						"
						SELECT *
						FROM wp_customers_ip
						WHERE cust_ip='$_COOKIE[customerIp]'
					");
				?>
                     <h2 class="products-num">
						Products: <b></b>
					</h2>
					<h2 class="discount">
						Your discount: <b><?php echo $customer_data[0]->cust_discount; ?></b>
					</h2>
                </div>

                <div class="col-md-6 col-xs-12 col-sm-6 breadcrumb-position">
					<ul class="page-breadcrumb">
						<?php if (function_exists('specia_breadcrumbs')) specia_breadcrumbs();?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="clearfix"></div>