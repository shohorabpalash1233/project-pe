<?php
	include_once ('lib/Database.php');
	include_once ('helper/Format.php');
?>
<?php
	class Product
	{
		private $db;
		private $fm;

		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insertProduct($title, $description, $catId, $entrydate, $size, $color, $stock, $purchase, $sell){

			$title 		= $this->fm->validation($title);
			$description= $this->fm->validation($description);
			$catId 		= $this->fm->validation($catId);
			$entrydate 	= $this->fm->validation($entrydate);
			$stock 		= $this->fm->validation($stock);
			$purchase 	= $this->fm->validation($purchase);
			$sell 		= $this->fm->validation($sell);

			$title 		= mysqli_real_escape_string($this->db->link, $title);
			$description= mysqli_real_escape_string($this->db->link, $description);
			$catId 		= mysqli_real_escape_string($this->db->link, $catId);
			$entrydate 	= mysqli_real_escape_string($this->db->link, $entrydate);
			$stock 		= mysqli_real_escape_string($this->db->link, $stock);
			$purchase 	= mysqli_real_escape_string($this->db->link, $purchase);
			$sell 		= mysqli_real_escape_string($this->db->link, $sell);


		$query = "INSERT INTO tbl_product(title, description, catId, size, color, entrydate, stock, purchase, sell)
		    	 VALUES 
		    	('$title', '$description', '$catId', '$size', '$color', '$entrydate', '$stock', '$purchase', '$sell')";

				$productIns = $this->db->insert($query);

				if ($productIns) {
					$msg = "Product inserted successfully";
					return $msg;
				} else {
					$msg = "Product not inserted!";
					return $msg;
				}
	}

		public function getAllProduct(){
			$query = "SELECT tbl_product.*, tbl_category.catName
					  FROM tbl_product
					  INNER JOIN tbl_category
					  ON
					  tbl_product.catId = tbl_category.catId
					  ORDER BY
					  tbl_product.id DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getProductById($id){
			$query = "SELECT * FROM tbl_product WHERE id = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function productUpdate($data, $size, $color, $id){

			$title 		= $this->fm->validation($data['title']);
			$description= $this->fm->validation($data['description']);
			$catId 		= $this->fm->validation($data['catId']);
			$entrydate 	= $this->fm->validation($data['entrydate']);
			$stock 		= $this->fm->validation($data['stock']);
			$purchase 	= $this->fm->validation($data['purchase']);
			$sell 		= $this->fm->validation($data['sell']);

			$title 		= mysqli_real_escape_string($this->db->link, $data['title']);
			$description= mysqli_real_escape_string($this->db->link, $data['description']);
			$catId 		= mysqli_real_escape_string($this->db->link, $data['catId']);
			$entrydate 	= mysqli_real_escape_string($this->db->link, $data['entrydate']);
			$stock 		= mysqli_real_escape_string($this->db->link, $data['stock']);
			$purchase 	= mysqli_real_escape_string($this->db->link, $data['purchase']);
			$sell 		= mysqli_real_escape_string($this->db->link, $data['sell']);


			if ($title == "" || $description == "" || $catId == "" || $entrydate == "" || $stock == "" || $purchase == "" ||   $sell == "") {

		    	$msg = "Fields Must Not Be Empty";
				return $msg;

		    	}

		    	$query = "UPDATE tbl_product
		    			  SET 
			    			  title 		= '$title',
			    			  description 	= '$description',
			    			  catId 		= '$catId',
			    			  size			= '$size',
			    			  color			= '$color',
			    			  entrydate 	= '$entrydate',
			    			  stock 		= '$stock',
			    			  purchase 		= '$purchase',
			    			  sell 			= '$sell'
		    			  WHERE id 	= '$id' ";

				$productUpdate = $this->db->update($query);

				if ($productUpdate) {
					$msg = "Product updated successfully";
					return $msg;
				} else {
					$msg = "Product not updated!";
					return $msg;
				}
	}
	public function delProductById($id){

			$query = "DELETE FROM tbl_product WHERE id = '$id' ";
			$deldata = $this->db->delete($query);
			header('Location: view-product.php');
			if ($deldata) {
					$msg = "Product deleted successfully";
					return $msg;
				} else {
					$msg = "Product not deleted!";
					return $msg;
				}

				$jsonData = file_get_contents('product-add.json');
         		$data = json_decode($jsonData, true);
         		foreach ($data as $value) {

		            $title = $value['title'];
		            $description = $value['description'];
		            $catId = $value['catId'];
		            $entrydate = $value['entrydate'];
		            $size = $value['size'];
		            $color = $value['color'];
		            $stock = $value['stock'];
		            $purchase = $value['purchase'];
		            $sell = $value['sell'];
		        }

				unset($data);

	            $delete[] = json_encode($data);
	            file_put_contents('product-add.json', $delete);

	}


}
?>



