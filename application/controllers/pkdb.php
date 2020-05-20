<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pkdb extends CI_Controller {
	public $error = array("err" => "");
	function __construct(){
    	parent::__construct();
        $this->load->model('upload');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');

    }

    //index
    //#links
    //#contacts
    //#bootstrap4
    public function test(){ 
      // $query=$this->db->query("SELECT pk.id ,pk.category,c1.title FROM `pkdb` as pk JOIN categories c1 ON (pk.category=c1.id)")->result_array();  
      // foreach ($query as $key) {
      //   $id=$key['id'];
      //   $t=$key['title'];
      //   $sql="insert into tags VALUES('$id','$t')";
      //   echo $sql."<br/>";
      //    //$this->db->query($sql);
      // }
    }
	public function index(){ 
    // $file_to_run=dirname(__DIR__)."\\..\\makeDBbackup.bat";
    // echo exec($file_to_run);die;    
    $query=$this->db->query("SELECT * FROM categories ORDER BY `categories`.`id`");
        $data['categories_data']=$query->result_array();
        $query=$this->db->query("SELECT * FROM pkdb");
        $data['code_data']=$query->result_array();

    $this->load->view('index',$data);
  }

	
	public function add_category(){
        $category=$this->input->post('category');
        $dataIns = array(
              'title' => $category
              );
        $this->upload->insert("categories",$dataIns);
        $redir=base_url()."pkdb";
        redirect($redir);
    }
    public function add_code(){
        $dataIns = array(
          'title' => $this->input->post('title'),
          'code' => $this->input->post('code'),
          'category' =>$this->input->post('category')
        );
        $tags=$this->input->post('tags');
        $this->upload->insert("pkdb",$dataIns);
        //insert all tags to db using model, insert id return id of this insertion
        $this->upload->insertAllTags($tags,$this->db->insert_id());
        $is_cat_page=$this->input->post('category');
        if($is_cat_page){
        	$redir=base_url()."pkdb/category_view/".$is_cat_page;
        }else{
        	$redir=base_url()."pkdb";
        }
        redirect($redir);
    }
    public function edit_code($id){
      $query=$this->db->query("SELECT * FROM pkdb WHERE id=".$id);
      $code_data = $query->result_array();
      $query=$this->db->query("SELECT tag FROM tags WHERE post_id=".$id);
      $tags=$query->result_array();
      $tagsare=array();
      foreach($tags as $row)
      { 
        array_push($tagsare, $row['tag']);
      }
      $tagsare=array($tagsare);

      $data=array_merge($code_data,$tagsare);

      echo json_encode($data);
    }

    public function update_code(){
    	$id=$this->input->post('id_is');
        $dataIns = array(
          'title' => $this->input->post('title'),
          'code' => $this->input->post('code'),
          'category' =>$this->input->post('category')
          );
      	$this->db->where('id', $id);
		$this->db->update('pkdb', $dataIns);
    //update tags
    $tags=$this->input->post('tags');
    $this->upload->insertAllTags($tags,$id);
		$is_cat_page=$this->input->post('category');
		if($is_cat_page){
        	$redir=base_url()."pkdb/category_view/".$is_cat_page;
        }else{
        	$redir=base_url()."pkdb";
        }
        redirect($redir);



         $dataIns = array(
          'title' => $this->input->post('title'),
          'code' => $this->input->post('code'),
          'category' =>$this->input->post('category')
        );

        $tags=$this->input->post('tags');
        $this->upload->insert("pkdb",$dataIns);
        //insert all tags to db using model, insert id return id of this insertion
        $this->upload->insertAllTags($tags,$this->db->insert_id());
        $is_cat_page=$this->input->post('category');




    }
    public function category_view($cat){   
        $query=$this->db->query("SELECT * FROM categories where id=$cat ORDER BY `categories`.`id`");
        $data['categories_data']=$query->row_array();
        $query=$this->db->query("SELECT * FROM pkdb WHERE category=$cat");
        $data['code_data']=$query->result_array();
        $this->load->view('category_view',$data);
  }
  public function save_tags($id){
    $tagsare=$_POST['datais'];
    $data=array();
    $this->db->query(
      "DELETE FROM `tags` WHERE `post_id`=$id"
    );
    foreach ($tagsare as $key) {
       $newarray=array(
        'post_id' =>$id ,
        'tag' =>$key
      );
       array_push($data, $newarray);
    }
    $this->db->insert_batch('tags', $data);
    // print_r($data);
  }

  public function readcategory(){
     if(!empty($_POST["keyword"])) {
      $sql="SELECT * FROM categories WHERE title like '" . $_POST["keyword"] . "%' ORDER BY title LIMIT 0,6";
      $query = $this->db->query($sql);
      $result=$query->result_array();
        if(!empty($result)){
        echo '<ul id="country-list">';
        foreach ($result as $key) {
         echo '<li onClick="select_tag(\''.$key["title"].'\')">'.$key["title"].'</li> ';
        }
        echo '</ul>';
      }

   }
}

    

    //#links
    public function links(){ //open links home page
        $query=$this->db->query("SELECT * FROM links ORDER BY `links`.`featured`  DESC ,link_text");
        $data['arrayData']=$query->result_array();
        $this->load->view('links',$data);
    }

    public function insertLinksData($status=0){
        $link_text=$this->input->post('link_text');
        $desc=$this->input->post('disc');
        $link=$this->input->post('link');
        $featured=$this->input->post('featured');
        if(!$featured){
            $featured=0;
        }
        $dataIns = array(
              'link_text' => $link_text,
              'description' => $desc,
              'link' => $link,
              'featured' =>$featured
              );
        $this->upload->insert("links",$dataIns);
        $redir=base_url()."pkdb/links";
        redirect($redir);
    }
    //#contacts
    public function contacts()
    {
        $query=$this->db->query("SELECT * FROM contacts ORDER BY name");
        $data['arrayData']=$query->result_array();
        $this->load->view('contacts',$data);
    }

    public function insertContactsData($status=0){
        $name=$this->input->post('name');
        $contact=$this->input->post('contact');
        $dataIns = array(
              'name' => $name,
              'contact' => $contact
              );
        $this->upload->insert("contacts",$dataIns);
        $redir=base_url()."pkdb/contacts";
        redirect($redir);

    }
    //#bootstrap4

    public function bootstrap4cheetsheet(){
        $query=$this->db->query("SELECT * FROM bootstrap4cheetsheet");
        $data['arrayData']=$query->result_array();
        $this->load->view('bootstrap4cheetsheet',$data);
    }

    public function inputBootstrap(){
        $this->load->view('inputBootstrap');
    }

    public function insertBootstrapNewCode(){


        //print_r($this->input->post());die;
        $title=$this->input->post('title');
        $code=$this->input->post('codeIs');
        $cate=$this->input->post('category');
        $dataIns = array(
              'title' => $title,
              'code' => $code,
              'category' =>$cate
              );
        $this->upload->insert("bootstrap4cheetsheet",$dataIns);
        $redir=base_url()."pkdb/inputBootstrap";
        redirect($redir);

        
    }

    //JQUERY

    public function jqueryCheatSheat(){
        $query=$this->db->query("SELECT * FROM jqueryCheatSheat");
        $data['arrayData']=$query->result_array();
        $this->load->view('jqueryCheatSheat',$data);
    }


    public function inputJquery(){
        $this->load->view('inputJquery');
    }

     public function insertJqueryCheatSheat(){


        //print_r($this->input->post());die;
        $title=$this->input->post('title');
        $description=$this->input->post('description');
        $code=$this->input->post('codeIs');
        $cate=$this->input->post('category');
        $dataIns = array(
              'title' => $title,
              'description' =>$description,
              'code' => $code,
              'category' =>$cate
              );
        $this->upload->insert("jqueryCheatSheat",$dataIns);
        $redir=base_url()."pkdb/inputJquery";
        redirect($redir);
    }
    //PHP
    public function phpCheetSheat(){
        $query=$this->db->query("SELECT * FROM phpCheatsheet  ORDER BY id");
        $data['arrayData']=$query->result_array();
        $this->load->view('php',$data);
    }


     public function insertPHP(){
        $title=$this->input->post('title');
        $description=$this->input->post('description');
        $code=$this->input->post('code');
        $cate=$this->input->post('category');
        $dataIns = array(
              'title' => $title,
              'description' =>$description,
              'code' => $code,
              'category' =>$cate
              );
      
        $this->upload->insert("phpcheatsheet",$dataIns);
        $redir=base_url()."pkdb/phpCheetSheat";
        redirect($redir);
    }

    public function deletePHP($id){
        $id=$id;
        $this->db->query('DELETE FROM phpCheatsheet WHERE id='.$id.'');
        $redir=base_url()."pkdb/phpCheetSheat";
        redirect($redir);
    }

    public function editPHP($id){
    	$query=$this->db->query("SELECT * FROM phpCheatsheet WHERE id=".$id);
        $row = $query->row();
        echo json_encode($row);
    }

    public function updatePHP(){
    	$id=$this->input->post('id');
        $title=$this->input->post('title');
        $description=$this->input->post('description');
        $code=$this->input->post('code');
        $cate=$this->input->post('category');
        $dataIns = array(
              'title' => $title,
              'description' =>$description,
              'code' => $code,
              'category' =>$cate
              );
      	$this->db->where('id', $id);
		$this->db->update('phpcheatsheet', $dataIns);
        $redir=base_url()."pkdb/phpCheetSheat";
        redirect($redir);
    }


       //Javascript
    public function javascriptCheatSheat(){
        $query=$this->db->query("SELECT * FROM javascriptcheatsheat  ORDER BY id");
        $data['arrayData']=$query->result_array();
        $this->load->view('javascriptcheatsheat',$data);
    }


     public function insertJAVASCRIPT(){
        $title=$this->input->post('title');
        $description=$this->input->post('description');
        $code=$this->input->post('code');
        $cate=$this->input->post('category');
        $dataIns = array(
              'title' => $title,
              'description' =>$description,
              'code' => $code,
              'category' =>$cate
              );
      
        $this->upload->insert("javascriptcheatsheat",$dataIns);
        $redir=base_url()."pkdb/javascriptCheatSheat";
        redirect($redir);
    }

    public function deleteJavascript($id){
        $id=$id;
        $this->db->query('DELETE FROM javascriptcheatsheat WHERE id='.$id.'');
        $redir=base_url()."pkdb/javascriptCheatSheat";
        redirect($redir);
    }

    public function editJavascript($id){
      $query=$this->db->query("SELECT * FROM javascriptcheatsheat WHERE id=".$id);
        $row = $query->row();
        echo json_encode($row);
    }

    public function updateJavascript(){
      $id=$this->input->post('id');
        $title=$this->input->post('title');
        $description=$this->input->post('description');
        $code=$this->input->post('code');
        $cate=$this->input->post('category');
        $dataIns = array(
              'title' => $title,
              'description' =>$description,
              'code' => $code,
              'category' =>$cate
              );
        $this->db->where('id', $id);
    $this->db->update('javascriptcheatsheat', $dataIns);
        $redir=base_url()."pkdb/javascriptCheatSheat";
        redirect($redir);
    }


    //WORDPRESS
    public function wordpressCheatSheat(){
        $query=$this->db->query("SELECT * FROM wordpresscheatsheat");
        $data['arrayData']=$query->result_array();
        $this->load->view('wordpresscheatsheat',$data);
    }


     public function insertWORDPRESS(){
        $title=$this->input->post('title');
        $description=$this->input->post('description');
        $code=$this->input->post('code');
        $cate=$this->input->post('category');
        $dataIns = array(
              'title' => $title,
              'description' =>$description,
              'code' => $code,
              'category' =>$cate
              );
      
        $this->upload->insert("wordpresscheatsheat",$dataIns);
        $redir=base_url()."pkdb/wordpressCheatSheat";
        redirect($redir);
    }

    public function deleteWordpress($id){
        $id=$id;
        $this->db->query('DELETE FROM wordpresscheatsheat WHERE id='.$id.'');
        $redir=base_url()."pkdb/wordpressCheatSheat";
        redirect($redir);
    }

    public function editWordpress($id){
      $query=$this->db->query("SELECT * FROM wordpresscheatsheat WHERE id=".$id);
        $row = $query->row();
        echo json_encode($row);
    }

    public function updateWordpress(){
      $id=$this->input->post('id');
        $title=$this->input->post('title');
        $description=$this->input->post('description');
        $code=$this->input->post('code');
        $cate=$this->input->post('category');
        $dataIns = array(
              'title' => $title,
              'description' =>$description,
              'code' => $code,
              'category' =>$cate
              );
        $this->db->where('id', $id);
    $this->db->update('wordpresscheatsheat', $dataIns);
        $redir=base_url()."pkdb/wordpressCheatSheat";
        redirect($redir);
    }



     //TUTORIALS
    public function tutorialcheatsheet(){
        $query=$this->db->query("SELECT * FROM tutorialcheatsheet");
        $data['arrayData']=$query->result_array();
        $this->load->view('tutorialcheatsheet',$data);
    }


     public function insertTutorial(){
        $title=$this->input->post('title');
        $description=$this->input->post('description');
        $code=$this->input->post('code');
        $cate=$this->input->post('category');
        $dataIns = array(
              'title' => $title,
              'description' =>$description,
              'code' => $code,
              'category' =>$cate
              );
      
        $this->upload->insert("tutorialcheatsheet",$dataIns);
        $redir=base_url()."pkdb/tutorialcheatsheet";
        redirect($redir);
    }

    public function deletetutorial($id){
        $id=$id;
        $this->db->query('DELETE FROM wordpresscheatsheat WHERE id='.$id.'');
        $redir=base_url()."pkdb/wordpressCheatSheat";
        redirect($redir);
    }

    public function editTutorial($id){
      $query=$this->db->query("SELECT * FROM wordpresscheatsheat WHERE id=".$id);
        $row = $query->row();
        echo json_encode($row);
    }

    public function updateTutorial(){
      $id=$this->input->post('id');
        $title=$this->input->post('title');
        $description=$this->input->post('description');
        $code=$this->input->post('code');
        $cate=$this->input->post('category');
        $dataIns = array(
              'title' => $title,
              'description' =>$description,
              'code' => $code,
              'category' =>$cate
              );
        $this->db->where('id', $id);
    $this->db->update('wordpresscheatsheat', $dataIns);
        $redir=base_url()."pkdb/wordpressCheatSheat";
        redirect($redir);
    }
}