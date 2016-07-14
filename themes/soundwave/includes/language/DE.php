<?php

	$months = array(
      'Jän',
      'Feb',
      'Mär',
      'Apr',
      'Mai',
      'Jun',
      'Jul',
      'Aug',
      'Sep',
      'Okt',
      'Nov',
      'Dez'
    );
    $weekday = array(
      'Montag',
      'Dienstag',
      'Mittwoch',
      'Donnerstag',
      'Freitag',
      'Sonnabend',
      'Sonntag'
    );
    $id_months = intval(strftime("%m", strtotime($data_event))) - 1;
	$id_weekday = intval(strftime("%u", strtotime($data_event))) - 1;
    $trans_months = htmlentities(utf8_decode($months[$id_months]));
	$trans_weekday = htmlentities(utf8_decode($weekday[$id_weekday]));
    $pretty_date_M = $trans_months;
	$pretty_date_w = $trans_weekday;
	
?>