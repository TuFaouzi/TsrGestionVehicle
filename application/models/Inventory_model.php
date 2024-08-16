<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inventory_model extends CI_Model {

    public function category_list() {
        return $this->db->select('*')
            ->from('category')
            ->where('active', 0)
            ->get()
            ->result();
    }


    public function category_edit($category_id = '') {
        return $this->db->select('*')
            ->from('category')
            ->where('category_id', $category_id)
            ->get()
            ->result(); 
    }

    function category_delete($category_id) {
        return $this->db->set('active', 1)
            ->where('category_id', $category_id)
            ->update('category'); 
    }

    public function category_save($data) {
        $data['posting_id'] = $this->session->userdata('user_id');
        if (!empty($data['category_id'])) {
            $this->db->where('category_id', $data['category_id']);
            $this->db->update('category', $data);
        } else {
            $this->db->insert('category', $data);
        }
    }

    public function get_category() {
        $categorylist = $this->db->get('category')->result();
        $categories[''] = lang("SELECT_CATEGORY");
        if (!empty($categorylist)) {
            foreach ($categorylist as $category) {
                $categories[$category->category_id] = $category->category_name;
            } 
        }
        return $categories;
    }

    public function get_location() {
        $query = $this->db->get('location')->result();
        $locations[''] = lang("SELECT_LOCATION");
        if (!empty($locationlist)) {
            foreach ($locationlist as $location) {
                $locations[$location->location_id] = $location->name;
            }
        }
        return $locations;
    }

    public function product_save($data) {
        $data['posting_id'] = $this->session->userdata('user_id');
        if (!empty($data['product_id'])) {
            $this->db->where('product_id', $data['product_id']);
            $this->db->update('product', $data);
        } else {

            $this->db->insert('product', $data);
        }
    }

    public function products_list() {
        $sql = "select product.*,
						category.category_name,
						location.name as location_name
				from product
					inner join category on category.category_id = product.category 
					inner join location on location.location_id = product.location
               where 
                    product.active = 0 ";
        return $this->db->query($sql)->result();
    }

    public function product_edit($product_id = '') {
        $this->db->select('*')
            ->from('product')
            ->where('product_id', $product_id)
            ->get()
            ->result(); 
    }

    function delete($product_id) {
        return $this->db->set('active', 1)
            ->where('product_id', $product_id)
            ->update('product');
    }

    public function location_save($data) { 
        $data['posting_id'] = $this->session->userdata('user_id');

        if (!empty($data['location_id'])) {
            $this->db->where('location_id', $data['location_id']);
            $this->db->update('location', $data);
        } else {
            $this->db->insert('location', $data);
        }
    }

    public function location_list() {
        return $this->db->select('*')
            ->from('location')
            ->where('active', 0)
            ->get()
            ->result(); 
    }

    public function loactioin_edit($location_id = '') {
        return $this->db->select('*')
            ->from('location')
            ->where('location_id', $location_id)
            ->get()
            ->result(); 
    }

    function location_delete($location_id) {
        return $this->db->set('active', 1)
            ->where('location_id', $location_id)
            ->update('location');
    }

    public function suppliers_save($data) {
        $data['posting_id'] = $this->session->userdata('user_id');
        if (!empty($data['suppliers_id'])) {
            $this->db->where('suppliers_id', $data['suppliers_id']);
            $this->db->update('supplier', $data);
        } else {
            $this->db->insert('supplier', $data);
        }
    }

    public function suppliers_list() {
        return $this->db->select('*')
            ->from('supplier')
            ->where('active', 0)
            ->get()
            ->result(); 
    }

    public function supplier_edit($suppliers_id = '') {
        return $this->db->select('*')
            ->from('supplier')
            ->where('suppliers_id', $suppliers_id)
            ->get()
            ->result();
    }

    public function supplire_delete($suppliers_id = '') {
        return $this->db->set('active', 1)
            ->where('suppliers_id', $suppliers_id)
            ->update('supplier');
    }

}
