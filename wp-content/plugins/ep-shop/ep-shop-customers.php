<style>
.customers_list {
	width: 50%;
    margin-top: 30px;
}

.customer-list-item {
	display: flex;
    justify-content: space-between;
    font-size: 20px;
    background: #dedede;
    padding: 5px 25px;
    border: 0.5px solid gray;
}

.customer-list-item p {
	font-size: 20px;
}

.customer-list-item input {
	width: 100px;
    font-size: 16px;
}
</style>
<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
<script>
$( document ).ready(function() {
	$(".customer-list-item").each(function() {
		if($(this).find(".h-man-times").text() >= 10) {
			$(this).find("input[type=\"text\"]").prop('readonly', false);
		} else {
			$(this).find("input[type=\"text\"]").prop('readonly', true);
		}
	});
});
</script>

<?php
require 'C:/xampp/htdocs/Example/wp-config.php';
require 'C:/xampp/htdocs/Example/wp-load.php';

function customers_list_page() {
	global $wpdb;
	if (!$wpdb) {
	$wpdb = new wpdb( DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
	} else {
		global $wpdb;
	}

	if (isset($_POST["submit"])) {
		$customerIps = $_POST["cust_ip"];
		$customerDiscounts = $_POST["discount"];
		$r = 0;
		foreach($customerIps as $customerIp) {
			$sql = "UPDATE `wp_customers_ip`
			SET cust_discount=$customerDiscounts[$r]
			WHERE cust_ip='$customerIp'";
			$wpdb->query($sql);
			$r++;
		}
	}
	$customers_list = $wpdb->get_results(
	"
	SELECT *
	FROM wp_customers_ip
	");
	
	if($customers_list) {
		?>
		<form method="POST"  id="customers_list">
			<div class="customers_list">
				<?php
				$i = 0;
				foreach($customers_list as $item) {
					?>
					<div class="customer-list-item">
						<p>IP: <b><?php echo $item->cust_ip; ?></b></p>
						<input type="hidden" name="cust_ip[<?php echo $i;?>]" value="<?php echo $item->cust_ip; ?>">
						<p>Discount: <input type="text" name="discount[<?php echo $i;?>]" value="<?php echo $item->cust_discount; ?>"></b></p>
						<p>How many times: <b class="h-man-times"><?php echo $item->cust_page_num; ?></b></p>
					</div>
				<?php $i++;} ?>
			</div>
			<input type="submit" name="submit" value="Save" >
		</form>
		<?php
	} else {
		echo 'No customers found.';
	}
}