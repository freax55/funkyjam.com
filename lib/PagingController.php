<?php
require_once(dirname(__FILE__) . '/BaseController.php');

class PagingController extends BaseController
{
	var $amount = 20;
	var $pageAmount = 10;

	var $page = null;
	var $pageInfo = null;
	
	function PagingController() {
		$this->BaseController();

		$this->_gw_default_action = 'list';
	}

    function prepareList() {
		if (!$this->page) {
			$this->page = 1;
		}

		$this->prepareListBase();
	}

	function prepareListBase() {
		$this->prepareCommonBase();
	}

	function setPageInfo($total) {
		$page = $this->page;
		if (!$page) {
			$page = 1;
		}
		$amount = $this->amount;
		$pageAmount = $this->pageAmount;

		if (!$amount) {
			$this->pageInfo = null;
			return;
		}

		$first = ($page - 1) * $amount + 1;
		$last = $first + $amount - 1;
		if ($total < $last) {
			$last = $total;
		}
		$pageTotal = ceil($total / $amount);
		$next = $page + 1;
		if ($pageTotal <= $page) {
			$next = null;
		}
		$prev = $page - 1;
		if ($page <= 1) {
			$prev = null;
		}
		
		if ($pageAmount) {
			$pageFirst = $page - (ceil($pageAmount / 2) - 1);
			$pageLast = $page + floor($pageAmount / 2);
			if ($pageFirst < 1) {
				$pageLast += 1 - $pageFirst;
				$pageFirst = 1;
				if ($pageTotal < $pageLast) {
					$pageLast = $pageTotal;
				}
			}
			if ($pageTotal < $pageLast) {
				$pageFirst += $pageTotal - $pageLast;
				$pageLast = $pageTotal;
				if ($pageFirst < 1) {
					$pageFirst = 1;
				}
			}
			$pageNext = $page + $pageAmount;
			if ($pageTotal < $pageNext) {
				$pageNext = $pageTotal;
			}
			if ($pageTotal <= $pageLast) {
				$pageNext = null;
			}
			$pagePrev = $page - $pageAmount;
			if ($pagePrev < 1) {
				$pagePrev = 1;
			}
			if ($pageFirst <= 1) {
				$pagePrev = null;
			}
		}

		$pageInfo = array();
		$pageInfo['page'] = $page;
		$pageInfo['amount'] = $amount;
		$pageInfo['total'] = $total;
		$pageInfo['first'] = $first;
		$pageInfo['last'] = $last;
		$pageInfo['next'] = $next;
		$pageInfo['prev'] = $prev;
		$pageInfo['pageAmount'] = $pageAmount;
		$pageInfo['pageTotal'] = $pageTotal;
		$pageInfo['pageFirst'] = $pageFirst;
		$pageInfo['pageLast'] = $pageLast;
		$pageInfo['pageNext'] = $pageNext;
		$pageInfo['pagePrev'] = $pagePrev;
		
		$this->pageInfo = $pageInfo;
	}
}
?>