<?php
namespace OC\CPM\P3; 

class Manager {
	protected function connectionDb() {
	$db = new \PDO('mysql:host=localhost; dbname=OC_Projet3; charset=utf8', 'root', 'root');
	
	return $db;	
	}
}
