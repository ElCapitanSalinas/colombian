<?php
/**
 * Rank Table v1.0b
 * By Dimitris 4463
 * greeceairwaysva.com/fss
 * Dimitris4463 on phpVMS forums 
 */  


class Rank extends CodonModule 
{

		public function index()
{
		$this->set('ranks', RanksData::GetAllRanks());
		$this->render('ranks_allranks.tpl');
		
		}
}
?>
