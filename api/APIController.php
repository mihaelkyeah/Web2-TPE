<?php
require_once('models/UserModel.php');
require_once('models/InsModel.php');
require_once('models/CommentModel.php');
require_once('api/APIView.php');

// Controlador para la API de los comentarios
class ApiController {

    private $userModel;
    private $insModel;
    private $commentModel;
    private $view;

    public function __construct() {
        $this->userModel = new UserModel();
        $this->insModel = new InsModel();
        $this->commentModel = new CommentModel();
        $this->view = new APIView();
    }

    public function getComments($params = []) {
        if(!empty($params)) {
            $id_ins = $params[':ID'];
            $comments = $this->commentModel->getInsComments($id_ins);
            
            /* // prueba para el router
            foreach($comments as $comment)
                echo('<strong>'.($comment->id_user_fk).'</strong><br>'.
                    ($comment->content).'<br>'
                );
            die(); */

            if ($comments) {
                $this->view->response($comments, 200);
            } else {
                $this->view->response(null, 200);
            }
        }
    }

    public function postComment() {
        $params = json_decode(file_get_contents("php://input"));
        $this->commentModel->saveComment($params->id_ins_fk, $params->id_user_fk, $params->content, $params->rating);
        $this->view->response($params, 200);
    }

    // public function editComment($params = []) {
    // }

    public function deleteComment($params = []) {
        if (!empty($params)) {
            $id = $params[':ID'];
            $success = $this->commentModel->getComment($id);
            if (!empty($success)) {
                $this->commentModel->deleteComment($id);
                $this->view->response(true, 200);
            }
            else {
                $this->view->response('The comment cannot be deleted because it does not exist.', 200);
            }
        }
        else {
            $this->view->response(false, 404);
        }
    }

    public function funcionDeMuestra() {
        echo('Hola mundo');
    }

}

?>