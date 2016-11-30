<?php
/**
*
*	Hadron Framework: Database Interface
*	Created by Azareal.
*	Licensed under the terms of the GPLv3.
*	Copyright Azareal (c) 2013 - 2014.
*
**/

namespace Hadron;

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

/**
*
*	We have an interface to enforce consistency between database classes.
*
**/
interface int_database
{
	public function __construct($main);
	public function connect($host, $user, $pass);
	public function select_db($name);
	public function set_prefix($prefix = "");
	public function create_table($name, $fields, $primary = null);
	public function insert($table, $values);
	public function force_insert($table, $values, $where = null);
	public function delete($table, $where = null);
	public function query($query, $critical = false);
	public function __invoke($query);
	public function sanitise($string);
	public function num_rows($result);
	public function row_count($table, $row = '*', $where = null, $critical = false);
	public function get($columns, $table, $where = null, $limit = null, $order = null, $options = null);
	public function join($columns, $table, $table2, $tmain, $tmain2, $where = null, $limit = null, $order = null);
	public function super_join($columns, $tables, $tmain, $where = null, $limit = null, $order = null);
	public function fetch_array($result);
	public function update($table, $update, $where = null, $shutdown = false);
	public function diff_update($table, $update, $where = null, $current = false);
	public function bulk_update($table, $update, $shutdown = false);
	public function exists($name);
	public function addColumn($table, $column, $type, $order = null);
	public function removeColumn($table, $column);
	public function columnExists($table, $column);
	public function getColumns($table);
	public function last_id();
	public function error();
}