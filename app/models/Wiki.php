<?php
class Wiki
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getWikis()
    {
        $this->db->query("SELECT wikis.*, categories.category_name, GROUP_CONCAT(tags.tag_name) AS tags
                         FROM wikis
                         LEFT JOIN categories ON wikis.category_id = categories.category_id
                         LEFT JOIN wikitags ON wikis.wiki_id = wikitags.wiki_id
                         LEFT JOIN tags ON wikitags.tag_id = tags.tag_id
                         GROUP BY wikis.wiki_id");
        return $this->db->resultSet();
    }

    public function addWikiWithCategoryAndTags($data)
    {
        $this->db->query('INSERT INTO wikis (title, content, author_id, category_id) VALUES (:title, :content, :author_id, :category_id)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':author_id', $_SESSION['user_id']);
        $this->db->bind(':category_id', $data['category_id']);

        if ($this->db->execute()) {
            $wiki_id = $this->db->lastInsertId();

          
            foreach ($data['tags'] as $tag_id) {
                $this->db->query('INSERT INTO wikitags (wiki_id, tag_id) VALUES (:wiki_id, :tag_id)');
                $this->db->bind(':wiki_id', $wiki_id);
                $this->db->bind(':tag_id', $tag_id);
                $this->db->execute();
            }

            return true;
        } else {
            return false;
        }
    }

    public function updateWiki($data)
    {
        // Update the main wiki information
        $this->db->query('UPDATE wikis SET title = :title, content = :content, category_id = :category_id WHERE wiki_id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':category_id', $data['category_id']);
    
        if ($this->db->execute()) {
            // Delete existing tags for the wiki
            $this->db->query('DELETE FROM wikitags WHERE wiki_id = :id');
            $this->db->bind(':id', $data['id']);
            $this->db->execute();
    
            // Insert new tags for the wiki
            foreach ($data['tags'] as $tag_id) {
                $this->db->query('INSERT INTO wikitags (wiki_id, tag_id) VALUES (:wiki_id, :tag_id)');
                $this->db->bind(':wiki_id', $data['id']);
                $this->db->bind(':tag_id', $tag_id);
                $this->db->execute();
            }
    
            return true;
        } else {
            return false;
        }
    }
    

    public function getWikiById($id)
    {
        $this->db->query("SELECT wikis.*, categories.category_name, GROUP_CONCAT(tags.tag_id) AS tag_ids
                     FROM wikis
                     LEFT JOIN categories ON wikis.category_id = categories.category_id
                    
                     LEFT JOIN tags ON wikis.category_id = tags.category_id
                     WHERE wikis.wiki_id = :id
                     GROUP BY wikis.wiki_id");

        $this->db->bind(':id', $id);
        $row = $this->db->single();

    
        if (property_exists($row, 'tag_ids')) {
            $row->tags = explode(',', $row->tag_ids);
        } else {
            $row->tags = [];
        }

        return $row;
    }

    public function getCategories()
    {
        $this->db->query('SELECT * FROM categories');
        return $this->db->resultSet();
    }

    public function getTags()
    {
        $this->db->query('SELECT * FROM tags');
        return $this->db->resultSet();
    }



    public function deleteWiki($id)
    {
        // First, delete the associated tags
        $this->db->query('DELETE FROM wikitags WHERE wiki_id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();

        // Then, delete the wiki
        $this->db->query('DELETE FROM wikis WHERE wiki_id = :id');
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }



    public function getTotalWikisCount()
    {
        $this->db->query('SELECT COUNT(*) AS total FROM wikis');
        return $this->db->single()->total;
    }
}