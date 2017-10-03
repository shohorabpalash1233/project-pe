<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helper/Format.php');
?>
<?php
	/**
	* 
	*/
	class Category
	{
		private $db;
		private $fm;

		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function catAdd($catName){
			$catName = $this->fm->validation($catName);

			$catName = mysqli_real_escape_string($this->db->link, $catName);
			if (empty($catName)) {
				$msg = "Category Name must not be empty";
				return $msg;
			} else {
				$query = "SELECT * FROM tbl_category WHERE catName = '$catName' ";
				$catCheck = $this->db->select($query);
				if ($catCheck != '0') {
					$msg = "Category Already Added! Add a different one.";
					return $msg;
				}else{
					$query = "INSERT into tbl_category(catName) VALUES ('$catName')";
					$catInsert = $this->db->insert($query);
					if ($catInsert) {
						$msg = "Category inserted successfully";
						return $msg;
					} else {
						$msg = "Category not inserted!";
						return $msg;
					}
				}

			}
		}

		public function getAllCategory(){
			$query = "SELECT * FROM tbl_category ORDER BY catId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getCatById($id){
			$query = "SELECT * FROM tbl_category WHERE catId = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function categoryUpdate($catName, $id){
			$catName = $this->fm->validation($catName);

			$catName = mysqli_real_escape_string($this->db->link, $catName);
			if (empty($catName)) {
				$msg = "Category Name must not be empty";
				return $msg;
			} else {
				$query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id'";
				$catUpdate = $this->db->update($query);
				if ($catUpdate) {
					$msg = "Category updated successfully";
					return $msg;
				} else {
					$msg = "Category not updated!";
					return $msg;
				}
			}
		}

		public function delCategoryById($id){
			$query = "DELETE FROM tbl_category WHERE catId = '$id' ";
			$deldata = $this->db->delete($query);
			if ($deldata) {
					$msg = "Category deleted successfully";
					return $msg;
				} else {
					$msg = "Category not deleted!";
					return $msg;
				}
		}
		
	}
?>