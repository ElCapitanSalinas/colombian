<?php
/**
 * Award Table v1.0b
 * By Dimitris 4463
 * greeceairwaysva.com/fss
 * Dimitris4463 on phpVMS forums 
 */  


class Awards extends CodonModule 
{

		public function index()
{
		$this->set('awards', AwardsData::GetAllAwards());
		$this->render('awards_allawards.php');
		
		}
}
?>
