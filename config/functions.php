<?php 
session_start();
date_default_timezone_set("Asia/Jakarta");

class functions {
	public $conn;
	public $baseurl;
	public $breadcrumbs;
	public $title;
	public $subtitle;

	public function __construct()
	{
		$this->conn = mysqli_connect("localhost","root","","dbspp");
		$this->baseurl = "http://localhost/pembayaranspp/";
	}

	public function set_breadcrumbs($list)
	{
		$this->breadcrumbs = $list;
	}

	public function set_title($title)
	{
		$this->title = $title;
	}

	public function set_subtitle($subtitle)
	{
		$this->subtitle = $subtitle;
	}

	public function siteinfo($show)
	{
		$get = $this->get_data("SELECT * FROM tblsekolah WHERE identitas = '$show'");
		return $get['value'];
	}

	public function get_data($query)
	{
		$query = mysqli_query($this->conn,$query);
		return mysqli_fetch_assoc($query);
	}
}