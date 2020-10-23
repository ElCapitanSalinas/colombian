<?php
//Selwyn Orren addon module for phpVMS virtual airline system
//
//Selwyn's addon modules are licenced under the following license:
//Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
//To view full icense text visit http://creativecommons.org/licenses/by-nc-sa/3.0/
//
//@author Selwyn Orren
//@copyright Copyright (c) 2009-2010, Selwyn Orren
//@license http://creativecommons.org/licenses/by-nc-sa/3.0/


class MyDownloads extends CodonModule
{
	public function index()
	{
		if(!Auth::LoggedIn())
		{
			echo '<h1>Error</h1>You must be logged in to access this page!';
			return;
		}
	}
	public function get_category_downloads($id)
	{
		if(!Auth::LoggedIn())
		{
			echo '<h1>Error</h1>You must be logged in to access this page!';
			return;
		}
		$this->set('downloads', DownloadData::GetDownloads($id));
		$this->set('allcategories', array(DownloadData::GetAsset($id)));
		$this->show('MyDownloads.php');
	}
}
