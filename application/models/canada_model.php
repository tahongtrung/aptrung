<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Canada_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    public function get_news()
    {
        $this->db->limit(1, 0);
        $this->db->order_by("time", "desc");
        $query = $this->db->get('news');
        return $query->result();
    }

    public function get_news1()
    {
        $this->db->limit(1, 1);
        $this->db->order_by("time", "desc");
        $query = $this->db->get('news');
        return $query->result();
    }

    public function get_news2()
    {
        $this->db->limit(5, 2);
        $this->db->order_by("time", "desc");
        $query = $this->db->get('news');
        return $query->result();
    }

    public function get_menu()
    {
        $this->db->select('menus.*');
        //$this->db->where('parent_id','3');
        //$this->db->or_where('parent_id','4');
        $query = $this->db->get('menus');
        return $query->result();
    }
    public function get_subnew()
    {
        $this->db->select('menus.*');
        $this->db->where('parent_id','3');
        //$this->db->or_where('parent_id','4');
        $query = $this->db->get('menus');
        return $query->result();
    }

    public function get_menu1()
    {
        $this->db->select('menus.*');
        $this->db->where('parent_id', '2');
        $this->db->limit(5, 0);
        $query = $this->db->get('menus');
        return $query->result();
    }

    public function get_menu2()
    {
        $this->db->select('menus.*');
        $this->db->where('parent_id', '2');
        $this->db->limit(5, 5);
        $query = $this->db->get('menus');
        return $query->result();
    }

    public function get_menu3()
    {
        $this->db->select('menus.*');
        $this->db->where('parent_id', '2');
        $this->db->limit(5, 10);
        $query = $this->db->get('menus');
        return $query->result();
    }

    public function get_newscontent($alias)
    {
        $this->db->select('news.*, menus.*,news.content_vi as content_news_vi,
                                    news.content_en as content_news_en,
                                    menus.name_en as menuname_en,
                                    menus.name_vi as menuname_vi,
                                    ');
        $this->db->join('menus','menus.id=news.category_id','left');
        $this->db->where('news.alias_vi', $alias);
        $this->db->or_where('news.alias_en', $alias);
        $query = $this->db->get('news');
        return $query->result();
    }

    public function get_menuscontent($alias)
    {
        $this->db->select('menus.*');
        $this->db->where('alias_vi', $alias);
        $this->db->or_where('alias_en', $alias);
        $query = $this->db->get('menus');
        return $query->result();
    }
    function sub_news(){
        $this->db->select('menus.*');
        $this->db->where('type', 'sub1');
        $this->db->where('id', '3');;
        $query = $this->db->get('menus');
        return $query->result();
    }
    function sub_about(){
        $this->db->select('menus.*');
        $this->db->where('type', 'sub1');
        $this->db->where('id', '4');;
        $query = $this->db->get('menus');
        return $query->result();
    }
    public function getnew_bycategory($category_alias)
    {
        $this->db->select('news.*,menus.*, news.alias_vi as news_alias');
        $this->db->where('menus.alias_vi', $category_alias);
        $this->db->or_where('menus.alias_en', $category_alias);
        $this->db->join('news', 'news.category_id = menus.id');
        $query = $this->db->get('menus');
        return $query->result();
    }
    public function getnew_bycategory_for_pagination($category_alias,$limit,$offset)
    {
        $this->db->select('news.*,menus.*, news.alias_vi as news_alias');
        $this->db->where('menus.alias_vi', $category_alias);
        $this->db->or_where('menus.alias_en', $category_alias);
        $this->db->join('news', 'news.category_id = menus.id');
        $this->db->order_by("news.id", "desc"); 
        $query = $this->db->get('menus',$limit,$offset);
        return $query->result();
    }
    function search(){
        $keyword    =   $this->input->post('txt_keyword');
        $this->db->like('title_vi', $keyword);
        $this->db->or_like('title_en', $keyword);
        //$this->db->from('news');
        $query=$this->db->get('news');
        return $query->result();
    }
    function get_hoidap(){
        $this->db->select('hoidap.*');
        $query = $this->db->get('hoidap');
        return $query->result();
    }
    public function getMenu($parent_id = 0){
        $this->db->select('*');
        $this->db->where('parent_id',$parent_id);
        $query = $this->db->get('menus')->result_array();
        if(count($query) > 0){
            foreach($query as &$item){
                $sub = $this->getMenu($item['id']);
                if($sub != NULL){
                    $item['sub'] = $sub;
                }
            }
        }
        return $query;
    }

    public function addgopy($array){
        if(isset($array) && $array != NULL){
            $this->db->insert('hopthugopy',$array);
            return $this->db->insert_id();
        }
    }

    public function getMenuRight($id_parent){
        $this->db->select('*');
        $this->db->where('parent_id',$id_parent);
        $query = $this->db->get('menus');
        return $query->result_array();
    }

    public function getMenuParentById($id_parent){
        $this->db->select('*');
        $this->db->where('id',$id_parent);
        $query = $this->db->get('menus');
        return $query->first_row();
    }

    public function getMenuByAlias($alias){
        $this->db->select('*');
        $this->db->where('alias_vi',$alias);
        $this->db->or_where('alias_en',$alias);
        $query = $this->db->get('menus');
        return $query->first_row();
    }
    public function getNewByAlias($alias){
        $this->db->select('*');
        $this->db->where('alias_vi',$alias);
        $this->db->or_where('alias_en',$alias);
        $query = $this->db->get('news');
        return $query->first_row();
    }
    public function getMenuById($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get('menus');
        return $query->first_row();
    }
    public function getSlide(){
        $this->db->select('*');
        $this->db->where('id','-2');
        $query = $this->db->get('staticfile');
        return $query->result();
    }
    public function count_new_by_category($category_alias){
         $this->db->select('news.*,menus.*, news.alias_vi as news_alias');
        $this->db->where('menus.alias_vi', $category_alias);
        $this->db->or_where('menus.alias_en', $category_alias);
        $this->db->join('news', 'news.category_id = menus.id');
        return $this->db->count_all_results('menus');
        
    }
     public function count_thvn_by_category($category_alias){
         $this->db->select('timhieuvietnam.*,menus.*, timhieuvietnam.alias_vi as news_alias');
        $this->db->where('menus.alias_vi', $category_alias);
        $this->db->or_where('menus.alias_en', $category_alias);
        $this->db->join('timhieuvietnam', 'timhieuvietnam.category_id = menus.id');
        return $this->db->count_all_results('menus');
        
    }
    public function getthvn_bycategory_for_pagination($category_alias,$limit,$offset)
    {
        $this->db->select('timhieuvietnam.*,menus.*, timhieuvietnam.alias_vi as news_alias');
        $this->db->where('menus.alias_vi', $category_alias);
        $this->db->or_where('menus.alias_en', $category_alias);
        $this->db->join('timhieuvietnam', 'timhieuvietnam.category_id = menus.id');
        $this->db->order_by("timhieuvietnam.id", "desc"); 
        $query = $this->db->get('menus',$limit,$offset);
        return $query->result();
    }
    public function hoidap_content($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get('hoidap');
        return $query->result();
    }
    public function getThvnContent($alias){
         $this->db->select('timhieuvietnam.*, menus.*,timhieuvietnam.content_vi as content_news_vi,
                                    timhieuvietnam.content_en as content_news_en,
                                    menus.name_en as menuname_en,
                                    menus.name_vi as menuname_vi,
                                    ');
        $this->db->join('menus','menus.id=timhieuvietnam.category_id','left');
        $this->db->where('timhieuvietnam.alias_vi', $alias);
        $this->db->or_where('timhieuvietnam.alias_en', $alias);
        $query = $this->db->get('timhieuvietnam');
        return $query->result();
    }
	 public function getThvnByAlias($alias){
        $this->db->select('*');
        $this->db->where('alias_vi',$alias);
        $this->db->or_where('alias_en',$alias);
        $query = $this->db->get('timhieuvietnam');
        return $query->first_row();
    }
	public function get_menu_by_type($alias,$type){
		 $this->db->select('menus.*');
		 
        $this->db->where('alias_vi', $alias);
        $this->db->or_where('alias_en', $alias);
        $this->db->where('type', $type);
		$query = $this->db->get('menus');
        return $query->result();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */