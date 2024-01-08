<?php
class Tag
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getTags()
    {
        
            $this->db->query('SELECT *,
                            tags.tag_id as tagId,
                            tags.tag_name as tagName,
                            categories.category_id as categoryId,
                            categories.category_name as categoryName
                            FROM tags
                            LEFT JOIN categories
                            ON tags.category_id = categories.category_id
                            ORDER BY tags.tag_id DESC
                            ');

        $results = $this->db->resultSet();
        
   
        
        
        return $results;
    }

    
    
    


    public function addTag($data)
    {
        $this->db->query('INSERT INTO tags (tag_name) VALUES(:tag_name)');
        $this->db->query('INSERT INTO tags (tag_name, category_id) VALUES(:tag_name, :category_id)');
        $this->db->bind(':tag_name', $data['tag_name']);
        $this->db->bind(':category_id', $data['category_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteTag($id)
    {
        $this->db->query('DELETE FROM tags WHERE tag_id = :tag_id');
        $this->db->bind(':tag_id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateTag($data)
    {
        $this->db->query('UPDATE tags SET tag_name = :tag_name WHERE tag_id = :id');
        // $this->db->query('UPDATE tags SET tag_name = :tag_name, category_id = :category_id WHERE tag_id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':tag_name', $data['tag_name']);
        // $this->db->bind(':category_id', $data['category_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getTagById($id)
    {
        $this->db->query('SELECT * FROM tags WHERE tag_id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }
}