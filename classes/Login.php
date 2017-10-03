
<?php
	/**
	* User Class
	*/
	include_once ('lib/Session.php');
	include_once ('lib/Database.php');
	include_once ('helper/Format.php');

	class Login
	{	
		private $db;
		private $fm;
		
		function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function checkLogin($name, $password){
			$name = $this->fm->validation($_POST['name']);
			$password = $this->fm->validation($_POST['password']);

			$name = mysqli_real_escape_string($this->db->link, $name);
			$password = mysqli_real_escape_string($this->db->link, md5($password));

			$query = "SELECT * FROM tbl_login WHERE name = '$name' AND password = '$password' ";

			$result = $this->db->select($query);
			if ($result) {
				$value = $result->fetch_assoc();
				Session::init();
				Session::set('login', true);
				Session::set('user', $value['name']);
				Session::set('email', $value['email']);
				Session::set('password', $value['password']);
				Session::set('id', $value['id']);
				Session::set('type', $value['user_type']);

				header('Location: index.php');
			}else{
				$msg = "Username or Password not matched!";
				return $msg;
			}
		}

		public function addCustomer($name, $email, $password, $type){
			$name 		= $this->fm->validation($name);
			$email 		= $this->fm->validation($email);
			$password 	= $this->fm->validation($password);
			$type 		= $this->fm->validation($type);

			$name 		= mysqli_real_escape_string($this->db->link, $name);
			$email 		= mysqli_real_escape_string($this->db->link, $email);
			$password 	= mysqli_real_escape_string($this->db->link, md5($password));
			$type 		= mysqli_real_escape_string($this->db->link, $type);

			if ($name == '' || $email == '' || $password == '' || $type == '') {
				$msg =  "Field Must Not Be Empty!";
				return $msg;
			}else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
				$msg =  "Invalid Email Address!";
				return $msg;
			}else{
				$checkQuery = "SELECT * FROM tbl_login WHERE name = '$name' AND email = '$email' ";
				$chkResult = $this->db->select($checkQuery);
				if ($chkResult != false) {
					$msg =  "Name or Email Address Already Exists!";
					return $msg;
				}else{
					$query = "INSERT INTO tbl_login(name, email, password, user_type) VALUES ('$name', '$email', 
					'$password', '$type')";
					$insertRow = $this->db->insert($query);
					if ($insertRow) {
						$msg = "Customer Added Successfully!";
						return $msg;
					}else{
						$msg = "Error! Not Added!";
						return $msg;
					}
				}
			}

		}

		public function getAllCustomer(){
			$query = "SELECT * FROM tbl_login WHERE user_type = 'Customer' ";
			$result = $this->db->select($query);
			return $result;

		}

		public function getCustomerById($id){
			$query = "SELECT * FROM tbl_login WHERE id = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function delCustomerById($id){
			$query = "DELETE FROM tbl_login WHERE id = '$id' ";
			$result = $this->db->delete($query);
			header('Location: view-customer.php');
			return $result;
		}

		public function updateCustomer($name, $email, $type, $id){

					$query = "UPDATE tbl_login
							SET
							name = '$name',
							email = '$email',
							user_type = '$type' 
							WHERE id = '$id' ";
					$result = $this->db->update($query);
					if ($result) {
						$msg =  "Customer Data Updated Successfully!";
						return $msg;
					}else{
						$msg =  "Customer Data Update Error!";
						return $msg;
					}
				}
	}
?>

