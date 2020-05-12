<?php
namespace Anker456\Controllers;
use Anker456\Models\User;

class Users {
	public function index() {
		$offset = !empty($_GET['start']) ? (int)$_GET['start'] : 0;
        $rows = !empty($_GET['len']) ? (int)$_GET['len'] : 10;
        $created_at = time() - 86400;//前24小时
        //测试发现：limit后面的数字不能使用预处理的'?'
        $sql = 'select * from lzc_users where created_at > ? order by id desc limit ' . $offset . ',' . $rows;
        $conditions = [$created_at];
        $result = User::get($sql, $conditions);
        var_dump($result);
	}
	public function store() {
		$name = !empty($_POST['name']) ? $_POST['name'] : '';
		$pwd = !empty($_POST['pwd']) ? $_POST['pwd'] : '123456';
		$pwd = password_hash($pwd, PASSWORD_DEFAULT);
		$sql = "insert lzc_users(`name`,`pwd`, `created_at`) values(?, ?, ?)";
		$conditions = [$name, $pwd, time()];
		$result = User::insert($sql, $conditions);
		var_dump($result);
	}
	public function show($id) {
		$sql = "select * from lzc_users where id=?";
		$conditions = [$id];
		$result = User::first($sql, $conditions);
		var_dump($result);
	}
	public function update() {
		$_PUT = array();
		if (strtolower($_SERVER['REQUEST_METHOD']) === 'put') {
			parse_str(file_get_contents('php://input'), $_PUT);
		}
		$id = !empty($_PUT['id']) ? $_PUT['id'] : 0;
		$pwd = !empty($_PUT['pwd']) ? $_PUT['pwd'] : '123456';
		$pwd = password_hash($pwd, PASSWORD_DEFAULT);
		$sql = "update lzc_users set `pwd`=? where id=?";
		$conditions = [$pwd, $id];
		$result = User::update($sql, $conditions);
		var_dump($result);
	}
	public function destroy($id) {
		$sql = "delete from lzc_users where id=?";
		$conditions = [$id];
		$result = User::delete($sql, $conditions);
		var_dump($result);
	}
}