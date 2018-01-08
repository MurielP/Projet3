<?php
require_once 'model/post_manager.php';
require_once 'entity/post.class.php';

require_once 'model/comment_manager.php';
require_once 'entity/comment.class.php';

require_once 'view/view.php';

class Post_control
{
	private $post_manager;

	public function __construct()
	{
		$this->post_manager = new Post_manager();
		$this->comment_manager = new Comment_manager();
	}

	/**
	 * [post affiche un post en fonction de son id ]
	 * @param  [int] $postId [id du post]
	 * @return un billet et ses commentaires
	 */
	public function post($postId)
	{
		$post = $this->post_manager->getPost($postId);
		$comments = $this->comment_manager->getComments($postId);
		$view = new View('post');
		$view->setTitle('Billet simple pour l\'Alaska');
		$view->generate(array(
			'post' => $post,
			'comments' => $comments));
	}

	/**
	 * [toComment laisser un commentaire]
	 * @param  [str] $author  [auteur]
	 * @param  [str] $comment [commentaire]
	 * @param  [int] $post_id [id du billet concerné]
	 * @return  page post actualisée
	 */
	public function toComment($author, $comment, $post_id)
	{
		$comment = new Comment(array(
				'author' => $author, 
				'comment' => $comment,
				'post_id' => $post_id,
 		));
		$this->comment_manager->addComment($comment->getAuthor(), $comment->getComment(), $comment->getPost_id());
		header('Location: index.php?action=post&id=' .$post_id );
	}
}


