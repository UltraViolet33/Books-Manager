<?php

require_once('../app/core/Database.php');
require_once('../app/models/Table.php');

class Book extends Table
{

    protected $table = "books";
    protected $id = "books_id";

    /**
     * insert 
     * @param string name
     * @return bool
     */
    public function insert($title, $author, $categoryId)
    {
        $query = "INSERT INTO $this->table (title, author, books_cat_id) VALUES (:title, :author, :categories_id)";
        $data['title'] = $title;
        $data['author'] = $author;
        $data['categories_id'] = $categoryId;
        return  $this->db->write($query, $data);
    }

    /**
     * getAll
     * get al the books from the BDD
     * @return array
     */
    public function getAll()
    {
        $db = Database::getInstance();
        $query = "SELECT * FROM books 
        JOIN categories 
        ON books.books_cat_id = categories.categories_id";
        return  $db->read($query);
    }

    /**
     * delete a category in the BDD
     * @param int $id
     */
    public function deleteBook($id)
    {
        $this->delete($id);
    }

    /**
     * select one category in the BDD from its ID
     * @param int $id
     * @return array
     */
    public function selectBook($id)
    {
        $query = "SELECT * FROM books JOIN categories ON books.books_cat_id = categories.categories_id WHERE $this->id = :id";
        $book =  $this->db->read($query, ['id' => $id]);
        return $book[0];
    }

    /**
     * updateCategory
     * @param int $id
     * @param string $name
     */
    public function updateBook($id, $title, $author, $categoryId)
    {
        $query = "UPDATE books SET title = :title, author = :author, books_cat_id = :categories_id WHERE $this->id = :id";
        $data['title'] = $title;
        $data['id'] = $id;
        $data['author'] = $author;
        $data['categories_id'] = $categoryId;
        return $this->db->write($query, $data);
    }
}