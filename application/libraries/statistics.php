<?php

class Statistics{


	/**
     * @return array ( array(week_no, orders) )
     * Don't play with this algorithm , ana mlz2ha :(
     */
	public static function weekly()
	{
		$statistics = array();
		$orders_no = 0;
		$last_week_no = -1;
		$last_last_week_no = 0;
		$first = true;
		foreach (Order::where('stage', ' > ', '1')->order_by('created_at', 'asc')->get() as $order) {
			if($first)$first_date = date('W', strtotime($order->created_at));
			$week_no = date('W',strtotime($order->created_at)) - $first_date;

			if($last_week_no != $week_no && !$first)
			{
				for ($i=$last_last_week_no + 1; $i < $last_week_no; $i++) { 
					array_push($statistics, array($i, 0));
				}
				array_push($statistics, array($last_week_no, $orders_no));
				$last_last_week_no = $last_week_no;
				$orders_no = 0;
			}
			$orders_no++;

			$last_week_no = $week_no;
			$first = false;
		}


		for ($i=$last_last_week_no + 1; $i < $last_week_no; $i++) { 
			array_push($statistics, array($i, 0));
		}
		array_push($statistics, array($last_week_no, $orders_no));

		return $statistics;

	}

}