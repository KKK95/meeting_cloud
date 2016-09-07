
<?php
$num = "1020501";
$num2 = "aaa";


$cart = array
(
  "num" => $num.$num2,
  "link" => array
  (
	array 
	(
		"func" => "add_member_to_group",
		"addr" => "add_member_to_group.php",
		"form" => array
		(
			"group_id" => "none",
			"member_id" => "none"
		)
	),
	array 
	(
		"func" => "test",
		"addr" => "test.php",
		"form" => array
		(
			"haha" => "none",
			"fuck you" => "none"
		)
	),
  )
  
);

//		$row=$result->fetch_array();				//rs 在這裏, fetch_assoc 的 index 只能用字串, 而 fetch_array 能用數字和字串作 index
		$cart['link']['group'] = array();
		$cart['link']['group']['name'] = array();
		$cart['link']['group']['del'] = array();
		$cart['link']['group']['check'] = array();
		for ($j=0; $j<=2; $j = $j+1)
		{
		//	 $cart['link']['group'][$i] = $j ;
			array_push( $cart['link']['group']['name'], 'Tom' );
			array_push( $cart['link']['group']['del'], 'delete');
			array_push( $cart['link']['group']['check'], 'check tom' );
		}
		$cart['link']['aaa'] = "hahaha" ;
	$json = array
	(
		"form" => array
		(
			array
			(
				"func" => "建立群組",
				"addr" => "build_group.php",
				"form" => array
				(
					"group_name" => "none",
					"group_leader_id" => "bbb"
				)
			)
		)
	);
	
	$json['form'][0]['form']['member_id'] = array();
	for ($j=1; $j<=20; $j = $j+1)
	{
		array_push( $json['form']['0']['form']['member_id'], 'none' );
	}
echo json_encode( $json );

?>