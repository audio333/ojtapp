<?php

class Pages
{
		// , $targetpage, $pagestring, $url	
	public function getPaginationString($page, $totalitems, $limit, $adjacents)
	{
				//how many items to show per page
		if($page) {
			$start = ($page - 1) * $limit; 			//first item to display on this page
		}else{
			$start = 0;								//if no page var is given, set start to 0
		}
		
		

		/* Setup page vars for display. */
		if ($page == 0){ 
			$page = 1;
		}					//if no page var is given, default to 1.
		$prev = $page - 1;							//previous page is page - 1
		$next = $page + 1;							//next page is page + 1
		$lastpage = ceil($totalitems/$limit);		//lastpage is = total pages / items per page, rounded up.
		$lpm1 = $lastpage - 1;						//last page minus 1
		
		/* 
			Now we apply our rules and draw the pagination object. 
			We're actually saving the code to a variable in case we want to draw it more than once.
		*/
		$pagination = "";
		if($lastpage > 1)
		{	
			$pagination .= "<nav arial-label=\"Page navigation\">";
			$pagination .= "<ul class=\"pagination\">";
			//previous button
			if ($page > 1){
				$pagination .= 
					"<li>
						<a href=\"#\" data-page=\"".$prev."\">
							<span aria-hidden=\"true\">«</span>
						</a>
					</li>";
			}else{
				$pagination .= 
				// "<span class=\"disabled\">� prev</span>";	
				"<li class=\"disabled\">
					<span aria-hidden=\"true\">«</span>
				</li>";
			}
			
			
			//pages	
			if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page){
						$pagination .= "<li class=\"active\"><a>$counter<span class=\"sr-only\"></span></a></li>";
					}else{
						$pagination .= "<li><a href=\"#\" data-page=\"".$counter."\">$counter</a></li>";					
					}
					
				}
			}
			elseif($lastpage >= 7 + ($adjacents * 2))	//enough pages to hide some
			{
				//close to beginning; only hide later pages
				if($page < 1 + ($adjacents * 3))		
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page){
							$pagination .= "<li class=\"active\"><a>$counter<span class=\"sr-only\"></a></span></li>";
						}else{
							$pagination .= "<li><a href=\"#\" data-page=\"".$counter."\">$counter</a></li>";					
						}
						
					}
					$pagination .= "<li><span class=\"elipses\">...</span></li>";
					$pagination .= "<li><a href=\"#\" data-page=\"".$lpm1."\">$lpm1</a></li>";
					$pagination .= "<li><a href=\"#\" data-page=\"".$lastpage."\">$lastpage</a></li>";		
				}
				//in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination .= "<li><a href=\"#\" data-page=\"1\">1</a></li>";
					$pagination .= "<li><a href=\"#\" data-page=\"2\">2</a></li>";
					$pagination .= "<li><span class=\"elipses\">...</span></li>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page){
							$pagination .= 
									"<li class=\"active\"><a>$counter<span class=\"sr-only\"></span></a></li>";
						}else{
							$pagination .= "<li><a href=\"#\" data-page=\"".$counter."\">$counter</a></li>";					
						}
					}
					$pagination .= "<li><span class=\"elipses\">...</span></li>";
					$pagination .= "<li><a href=\"#\" data-page=\"".$lpm1."\">$lpm1</a></li>";
					$pagination .= "<li><a href=\"#\" data-page=\"".$lastpage."\">$lastpage</a></li>";		
				}
				//close to end; only hide early pages
				else
				{
					$pagination .= "<li><a href=\"#\" data-page=\"1\">1</a></li>";
					$pagination .= "<li><a href=\"#\" data-page=\"2\">2</a></li>";
					$pagination .= "<li><span class=\"elipses\">...</span></li>";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page){
							$pagination .= "<li class=\"active\"><a>$counter<span class=\"sr-only\"></span></a></li>";
						}else{
							$pagination .= "<li><a href=\"#\" data-page=\"".$counter."\">$counter</a></li>";					
						}
						
					}
				}
			}
			
			//next button
			if ($page < $counter - 1){
				$pagination .= 
				// "<li><a href=\"#\" data-page=\"".$next."\">»</a></li>";
				"<li>
					<a href=\"#\" data-page=\"".$next."\">
						<span aria-hidden=\"true\">»</span>
					</a>
				</li>";
			}else{
				// $pagination .= "<span class='disabled'>next �</span>";
				$pagination .=
				"<li class=\"disabled\">
					<span aria-hidden=\"true\">»</span>
				</li>";
				$pagination .= "</ul>\n";
				$pagination .= "</nav>\n";
			}
			
		}
		
		return $pagination;
	}	

}

?>


	