<?php 
include_once('../../../../model/model.php');

$booking_type = $_POST['booking_type'];
$customer_id = $_POST['customer_id'];

if($booking_type=="Group Booking"){ 
$query = "select * from tourwise_traveler_details where customer_id='$customer_id'";  
 
		$sq_booking = mysql_query($query); 
		while($row_booking = mysql_fetch_assoc($sq_booking)){ 
			$sq_tour_group_name = mysql_query("select from_date,to_date from tour_groups where group_id='$row_booking[tour_group_id]' and status != 'Cancel'");
		$row_tour_group_name = mysql_fetch_assoc($sq_tour_group_name);
		$tour_group_from = date("d-m-Y", strtotime($row_tour_group_name['from_date']));
		$tour_group_to = date("d-m-Y", strtotime($row_tour_group_name['to_date'])); ?>
			<option value="<?php echo $row_booking['id']; ?>"><?php echo  $tour_group_from." To ".$tour_group_to ?></option>; 
	<?php 
	} 
   }
elseif($booking_type=="Package Booking"){
$query = "select * from package_tour_booking_master as m left join package_travelers_details as t on m.booking_id=t.booking_id where m.customer_id='$customer_id' and t.status != 'Cancel'";
		$sq_booking = mysql_query($query); 
		while($row_booking = mysql_fetch_assoc($sq_booking)){ ?>
			<option value="<?php echo $row_booking['booking_id']; ?>"><?php echo date('d-m-Y', strtotime($row_booking['tour_from_date'])).' To '. date('d-m-Y', strtotime($row_booking['tour_to_date'])) ?></option>; 
	<?php 
	} 
} ?>
 
<script>

	$('#booking_id').select2();
</script>