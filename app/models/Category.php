<?php

class Category
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getCategories()
    {
        $this->db->query('SELECT * FROM categories ORDER BY category_id DESC');
        $results = $this->db->resultSet();
        return $results;
    }

    public function addCategory($data)
    {
        $this->db->query('INSERT INTO categories (category_name) VALUES (:category_name)');
        $this->db->bind(':category_name', $data['category_name']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteCategory($id)
    {
        $this->db->query('DELETE FROM categories WHERE category_id = :category_id');
        $this->db->bind(':category_id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateCategory($data)
    {
        $this->db->query('UPDATE categories SET category_name = :category_name WHERE category_id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':category_name', $data['category_name']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getCategoryById($id)
    {
        $this->db->query('SELECT * FROM categories WHERE category_id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }


    public function getTotalCategories()
    {
    $this->db->query('SELECT COUNT(*) as total FROM categories');
    $row = $this->db->single();
 
    return $row->total;
    }
}