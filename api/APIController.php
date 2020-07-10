<?php
require_once('models/CommentModel.php');
require_once('api/APIView.php');

// Controlador para la API de los comentarios
class ApiController {

    private $commentModel;
    private $view;

    public function __construct() {
        $this->commentModel = new CommentModel();
        $this->view = new APIView();
    }

    // Trae los comentarios de la BD
    public function getComments($params = []) {

        if(!empty($params)) {
            $id_ins = $params[':ID_ins'];
            $comments = $this->commentModel->getInsComments($id_ins);

            if ($comments) {
                $this->view->response($comments, 200);
            } else {
                $this->view->response(null, 200);
            }
        }

    }

    // Guarda un comentario en la BD
    public function postComment() {

        $params = json_decode(file_get_contents("php://input"));

        $id_ins_fk = $params->id_ins_fk;
        $id_user_fk = $params->id_user_fk;
        $content = $params->content;
        $rating = $params->rating;

        $this->commentModel->saveComment($id_ins_fk, $id_user_fk, $content, $rating);
        $this->view->response($params, 200);

    }

    // Borra un comentario de la BD
    public function deleteComment($params = []) {

        if (!empty($params)) {
            $id = $params[':ID_comm'];
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

}

?>