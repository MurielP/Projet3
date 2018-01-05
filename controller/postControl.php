<?php
require_once 'model/postManager.php';
require_once 'entity/post.class.php';

require_once 'model/commentManager.php';
require_once 'entity/comment.class.php';

require_once 'view/view.php';

class PostControl
{
	private $postManager;

	public function __construct()
	{
		$this->postManager = new PostManager();
		$this->commentManager = new CommentManager();
	}

	/**
	 * [post affiche un post en fonction de son id ]
	 * @param  [int] $postId [id du post]
	 * @return un billet et ses commentaires
	 */
	public function post($postId)
	{
		$post = $this->postManager->getPost($postId);
		$comments = $this->commentManager->getComments($postId);
		$view = new View('Post');
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
		$this->commentManager->addComment($comment->getAuthor(), $comment->getComment(), $comment->getPost_id());
		header('Location: index.php?action=post&id=' .$post_id );
	}
}


