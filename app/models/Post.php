<?php
class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getPosts()
    {
        $this->db->query('SELECT *,
                          posts.id as postId,
                          users.id as userId,
                          posts.created_at as postCreated,
                          users.created_at as userCreated
                          FROM posts 
                          INNER JOIN users 
                          ON posts.user_id = users.id
                          ORDER BY posts.created_at DESC');

        $results = $this->db->resultSet();

        return $results;
    }

    //add post
    public function addPost($data)
    {


        $this->db->query('INSERT INTO posts (title,user_id,body) VALUES  (:title,:user_id,:body);');

        $this->db->bind(":title", $data['title']);
        $this->db->bind(":user_id", $data['user_id']);
        $this->db->bind(":body", $data['body']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //get post by Id
    public function getPostById($id)
    {
        try {
            $this->db->query('SELECT * FROM posts WHERE id = :id');

            $this->db->bind(':id', $id);

            $post = $this->db->single();

            return $post;
        } catch (PDOException $pdoe) {
            echo  $pdoe->getMessage();
        }
    }

    //update post 
    public function updatePost($data)
    {
        try {
            $this->db->query('UPDATE posts SET title = :title , body = :body WHERE id = :id;');

            $this->db->bind(":title", $data['title']);
            $this->db->bind(":id", $data['id']);
            $this->db->bind(":body", $data['body']);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $pdoe) {
            echo $pdoe->getMessage();
        }
    }
}
