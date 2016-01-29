<?php

function getPage($rowCount,$pageSize,$pageNum,$url){
		$pageCount=ceil($rowCount/$pageSize);

		if ($pageNum<=0) {
			$pageNum=1;
		}
		if ($pageNum>=$pageCount) {
			$pageNum=$pageCount;
		}

		if ($pageCount <10) {
			$start = 1;
			$end = $pageCount;
		}
		else if ($pageCount >= 10 && $pageCount < 20) {
			if($pageNum>4){
			$start = $pageNum - 3;
			if($pageNum==$pageCount){
			$end = $pageNum;
			}else{
				$end = $pageNum+3>$pageCount?$pageCount:$pageNum+3;
			}
			}else{
				$start=1;
				$end=8;
			}
		}
		elseif ($pageCount >= 20) {
			if($pageNum>4){
			$start = $pageNum - 3;
			if($pageNum==$pageCount){
			$end = $pageNum;
			}else{
				$end = $pageNum+3>$pageCount?$pageCount:$pageNum+3;
			}
			}else{
				$start=1;
				$end=8;
			}
		}

		$offset=($pageNum-1)*$pageSize;
		
		$rowPage['pageNum']=$pageNum;
		$rowPage['pageCount']=$pageCount;
		$rowPage['offset']=$offset;

		$next=$pageNum+1;
		$pre=$pageNum-1;

		$pageList.="<span>共".$pageCount."页/第".$pageNum."页</span>&nbsp;&nbsp;";
		if ($pageNum== 1){

			if($pageCount== 1){					
				$pageList.="<span>1</span>";
			}else{
			for($i=$start;$i<=$end;$i++){
				if ($pageNum==$i){					
					$pageList.="<span>".$i."</span>";
				}else{
					$pageList.="<a href=\"/xplan_backend/Plan_admin/index.php/home/".$url."/pageNum/".$i."\">".$i."</a>&nbsp;";
				}
			}

			$pageList.="<a href='/xplan_backend/Plan_admin/index.php/home/".$url."/pageNum/".$next."'>下一页</a>&nbsp;
			<a href=\"/xplan_backend/Plan_admin/index.php/home/".$url."/pageNum/".$pageCount."\">尾页</a>";
			}
		}else if($pageNum==$pageCount){

			$pageList.="<a href=\"/xplan_backend/Plan_admin/index.php/home/".$url."/pageNum/1\">首页</a>&nbsp;
			<a href='/xplan_backend/Plan_admin/index.php/home/".$url."/pageNum/".$pre."'>上一页</a>&nbsp;";

			for($i=$start;$i<=$end;$i++){
				if($pageNum==$i){					
					$pageList.="<span>".$i."</span>";
					}else{
					$pageList.="<a href=\"/xplan_backend/Plan_admin/index.php/home/".$url."/pageNum/".$i."\">".$i."</a>&nbsp;
					";}
			}
		
		}else if($pageNum > 1 && $pageNum < $pageCount){

			$pageList.="<a href=\"/xplan_backend/Plan_admin/index.php/home/".$url."/pageNum/1\">首页</a>&nbsp;
			<a href='/xplan_backend/Plan_admin/index.php/home/".$url."/pageNum/".$pre."'>上一页</a>&nbsp;";
			
			for($i=$start;$i<=$end;$i++){

				if($pageNum==$i){	

					$pageList.="<span>".$i."</span>";

				}else{

					$pageList.="<a href=\"/xplan_backend/Plan_admin/index.php/home/".$url."/pageNum/".$i."\">".$i."</a>&nbsp;";
					
					}
				}

			$pageList.="<a href='/xplan_backend/Plan_admin/index.php/home/".$url."/pageNum/".$next."'>下一页</a>&nbsp;
			<a href=\"/xplan_backend/Plan_admin/index.php/home/".$url."/pageNum/".$pageCount."\">尾页</a>";
			
			}	
		$rowPage['show']=$pageList;
		return $rowPage;
}

function getPageS($rowCount,$pageSize,$pageNum,$url,$uid){
		$pageCount=ceil($rowCount/$pageSize);

		if ($pageNum<=0) {
			$pageNum=1;
		}
		if ($pageNum>=$pageCount) {
			$pageNum=$pageCount;
		}

		if ($pageCount <10) {
			$start = 1;
			$end = $pageCount;
		}
		else if ($pageCount >= 10 && $pageCount < 20) {
			if($pageNum>4){
			$start = $pageNum - 3;
			if($pageNum==$pageCount){
			$end = $pageNum;
			}else{
				$end = $pageNum+3>$pageCount?$pageCount:$pageNum+3;
			}
			}else{
				$start=1;
				$end=8;
			}
		}
		elseif ($pageCount >= 20) {
			if($pageNum>4){
			$start = $pageNum - 3;
			if($pageNum==$pageCount){
			$end = $pageNum;
			}else{
				$end = $pageNum+3>$pageCount?$pageCount:$pageNum+3;
			}
			}else{
				$start=1;
				$end=8;
			}
		}

		$offset=($pageNum-1)*$pageSize;
		
		$rowPage['pageNum']=$pageNum;
		$rowPage['pageCount']=$pageCount;
		$rowPage['offset']=$offset;

		$next=$pageNum+1;
		$pre=$pageNum-1;

		$pageList.="<span>共".$pageCount."页/第".$pageNum."页</span>&nbsp;&nbsp;";
		if ($pageNum== 1){
			if($pageCount== 1){		
					$pageList.="<span>1</span>";	
			}else{
			for($i=$start;$i<=$end;$i++){
				if ($pageNum==$i){					
					$pageList.="<span>".$i."</span>";
				}else{
					$pageList.="<a href=\"/xplan_backend/Plan_admin/index.php/home/".$url."/uid/".$uid."/pageNum/".$i."\">".$i."</a>&nbsp;";
					}
				}

			$pageList.="<a href='/xplan_backend/Plan_admin/index.php/home/".$url."/uid/".$uid."/pageNum/".$next."'>下一页</a>&nbsp;
			<a href=\"/xplan_backend/Plan_admin/index.php/home/".$url."/uid/".$uid."/pageNum/".$pageCount."\">尾页</a>";
			}
		}else if($pageNum==$pageCount){

			$pageList.="<a href=\"/xplan_backend/Plan_admin/index.php/home/".$url."/uid/".$uid."/pageNum/1\">首页</a>&nbsp;
			<a href='/xplan_backend/Plan_admin/index.php/home/".$url."/uid/".$uid."/pageNum/".$pre."'>上一页</a>&nbsp;";

			for($i=$start;$i<=$end;$i++){
				if($pageNum==$i){					
					$pageList.="<span>".$i."</span>";
					}else{
					$pageList.="<a href=\"/xplan_backend/Plan_admin/index.php/home/".$url."/uid/".$uid."/pageNum/".$i."\">".$i."</a>&nbsp;
					";}
			}
		
		}else if($pageNum > 1 && $pageNum < $pageCount){

			$pageList.="<a href=\"/xplan_backend/Plan_admin/index.php/home/".$url."/uid/".$uid."/pageNum/1\">首页</a>&nbsp;
			<a href='/xplan_backend/Plan_admin/index.php/home/".$url."/uid/".$uid."/pageNum/".$pre."'>上一页</a>&nbsp;";
			
			for($i=$start;$i<=$end;$i++){

				if($pageNum==$i){	

					$pageList.="<span>".$i."</span>";

				}else{

					$pageList.="<a href=\"/xplan_backend/Plan_admin/index.php/home/".$url."/uid/".$uid."/pageNum/".$i."\">".$i."</a>&nbsp;";
					
					}
				}

			$pageList.="<a href='/xplan_backend/Plan_admin/index.php/home/".$url."/uid/".$uid."/pageNum/".$next."'>下一页</a>&nbsp;
			<a href=\"/xplan_backend/Plan_admin/index.php/home/".$url."/uid/".$uid."/pageNum/".$pageCount."\">尾页</a>";
			
			}

		$rowPage['show']=$pageList;
		return $rowPage;
}

function getPageC($rowCount,$pageSize,$pageNum,$url,$coachid){
		$pageCount=ceil($rowCount/$pageSize);

		if ($pageNum<=0) {
			$pageNum=1;
		}
		if ($pageNum>=$pageCount) {
			$pageNum=$pageCount;
		}

		if ($pageCount <10) {
			$start = 1;
			$end = $pageCount;
		}
		else if ($pageCount >= 10 && $pageCount < 20) {
			if($pageNum>4){
			$start = $pageNum - 3;
			if($pageNum==$pageCount){
			$end = $pageNum;
			}else{
				$end = $pageNum+3>$pageCount?$pageCount:$pageNum+3;
			}
			}else{
				$start=1;
				$end=8;
			}
		}
		elseif ($pageCount >= 20) {
			if($pageNum>4){
			$start = $pageNum - 3;
			if($pageNum==$pageCount){
			$end = $pageNum;
			}else{
				$end = $pageNum+3>$pageCount?$pageCount:$pageNum+3;
			}
			}else{
				$start=1;
				$end=8;
			}
		}

		$offset=($pageNum-1)*$pageSize;
		
		$rowPage['pageNum']=$pageNum;
		$rowPage['pageCount']=$pageCount;
		$rowPage['offset']=$offset;

		$next=$pageNum+1;
		$pre=$pageNum-1;

		$pageList.="<span>共".$pageCount."页/第".$pageNum."页</span>&nbsp;&nbsp;";
		if ($pageNum== 1){
			if($pageCount== 1){
				$pageList.="<span>1</span>";
				}else{
			for($i=$start;$i<=$end;$i++){
				if ($pageNum==$i){					
					$pageList.="<span>".$i."</span>";
				}else{
					$pageList.="<a href=\"/xplan_backend/Plan_admin/index.php/home/".$url."/coachid/".$coachid."/pageNum/".$i."\">".$i."</a>&nbsp;";
				}
			}

			$pageList.="<a href='/xplan_backend/Plan_admin/index.php/home/".$url."/coachid/".$coachid."/pageNum/".$next."'>下一页</a>&nbsp;
			<a href=\"/xplan_backend/Plan_admin/index.php/home/".$url."/coachid/".$coachid."/pageNum/".$pageCount."\">尾页</a>";
			}
		}else if($pageNum==$pageCount){

			$pageList.="<a href=\"/xplan_backend/Plan_admin/index.php/home/".$url."/coachid/".$coachid."/pageNum/1\">首页</a>&nbsp;
			<a href='/xplan_backend/Plan_admin/index.php/home/".$url."/coachid/".$coachid."/pageNum/".$pre."'>上一页</a>&nbsp;";

			for($i=$start;$i<=$end;$i++){
				if($pageNum==$i){					
					$pageList.="<span>".$i."</span>";
					}else{
					$pageList.="<a href=\"/xplan_backend/Plan_admin/index.php/home/".$url."/coachid/".$coachid."/pageNum/".$i."\">".$i."</a>&nbsp;
					";}
			}
		
		}else if($pageNum > 1 && $pageNum < $pageCount){

			$pageList.="<a href=\"/xplan_backend/Plan_admin/index.php/home/".$url."/coachid/".$coachid."/pageNum/1\">首页</a>&nbsp;
			<a href='/xplan_backend/Plan_admin/index.php/home/".$url."/coachid/".$coachid."/pageNum/".$pre."'>上一页</a>&nbsp;";
			
			for($i=$start;$i<=$end;$i++){

				if($pageNum==$i){	

					$pageList.="<span>".$i."</span>";

				}else{

					$pageList.="<a href=\"/xplan_backend/Plan_admin/index.php/home/".$url."/coachid/".$coachid."/pageNum/".$i."\">".$i."</a>&nbsp;";
					
					}
				}

			$pageList.="<a href='/xplan_backend/Plan_admin/index.php/home/".$url."/coachid/".$coachid."/pageNum/".$next."'>下一页</a>&nbsp;
			<a href=\"/xplan_backend/Plan_admin/index.php/home/".$url."/coachid/".$coachid."/pageNum/".$pageCount."\">尾页</a>";
			
			}
		$rowPage['show']=$pageList;
		return $rowPage;
}