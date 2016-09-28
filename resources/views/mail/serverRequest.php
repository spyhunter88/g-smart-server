<html>
	<head>
	</head>

	<body>
		<b>YÊU CẦU KHỞI TẠO SERVER</b>
		<br/><br/>

		Thông tin khách hàng: 	<b><?php echo $svr->user_name; ?></b><br/>
		<?php if ($to_dev) {
			echo 'ID Khách hàng:	<b>' . $svr->khachhang_id .'</b><br/>';
		} ?>
		Email:			<b><?php echo $svr->email; ?></b><br/>
		Điện thoại:		<b><?php echo $svr->phone; ?></b><br/>

		---------------------------------------------<br/>
		THÔNG TIN SERVER<br/><br/>


		CPU:			<b><?php echo $svr->cpu; ?></b><br/>
		RAM:			<b><?php echo $svr->ram; ?></b><br/>
		SSD:			<b><?php echo $svr->ssd; ?></b><br/>
		IOPS:			<b><?php echo $svr->iops; ?></b><br/>
		Bandwidth:		<b><?php echo $svr->bandwidth; ?></b><br/>
		IP:				<b><?php echo $svr->ip; ?></b><br/>
		OS:				<b><?php echo $svr->os; ?></b><br/>
		Thành tiền:		<b><?php echo $svr->price_month; ?> / tháng </b><br/>

		Ngày yêu cầu:	<b><?php echo date("Y-m-d H:i:s"); ?></b>

	</body>
</html>

