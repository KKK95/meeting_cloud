
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
//		array_push( $index['link'], NULL);
		//$em_view_group_list['link'][$row['name']] = "group.php?group_id=".$row['id'] ;
  //array_push( $em_view_group_list['link'][$i], array( "name" => value ));
  
 /* 
  $cart = array
(
  "num" => $num.$num2,
  "link" => array
  (
	  "group" => array(  )
  )
);
  
  	for($i=1;$i<=3;$i++) 
	{
		$cart['link']['group'][$i] = array();
		for ($j=100; $j<=300; $j = $j+100)
		{
			array_push( $cart['link']['group'][$i], array( $i => $j ));
		}
	}
  
  */
echo json_encode( $cart );

?>