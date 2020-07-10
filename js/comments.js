'use strict';

// Se cargan los datos del usuario actual desde los elementos del HTML
let username = document.querySelector('#commentSection').getAttribute('username');
let userID = document.querySelector('#commentSection').getAttribute('userID');
let insID = document.querySelector('#commentSection').getAttribute('insID')
let privilege = document.querySelector('#commentSection').getAttribute('privilege');

// Pide cargar los comentarios no bien se carga la página
document.addEventListener('DOMContentLoaded', function(){
    getComments();
});

var commentsList = new Vue({
    el: '#comments',
    data: {
        error: false,
        loading: false,
        privilege: privilege,
        ins_comments: []
    },
    methods: {
        /**
         * Elimina un comentario por id
         */
        removeComment: function (commentID) {
            deleteComment(commentID)
        }
    }
});

var averageRating = new Vue({
    el: '#averageRating',
    data: {
        loading: true,
        users_rating: null
    }
});

var formPostComment = new Vue({
    el:'#comment-form',
    data: {
        userComment: null,
        rating: null,
        username: username,
        privilege: privilege
    },
    methods: { 
        // Responde al botón en el formulario de Vue
        sendComment: function(e) {
            // Previene la recarga automática de la página
            e.preventDefault(e);
            // Prepara un JSON con los datos del comentario y del autor
            let comment = {
                id_ins_fk: insID,
                id_user_fk: userID,
                content: userComment.value,
                rating: rating.value
            };

            // Envía el JSON al método para postear el comentario
            postComment(comment);
            /*
            commentsList.error = false;
            commentsList.loading = true;
            commentsList.ins_comments = [];
            */
            formPostComment.userComment = null;
            formPostComment.rating = null;
        }
    }
});

// Trae los comentarios de la API
function getComments() {

    fetch('api/comments/'+insID)
    .then(response => response.json())
    .then(ins_comments => {
        if(ins_comments == null) {
            commentsList.error = true;
        }
        else {
            commentsList.ins_comments = ins_comments;
            averageRating.users_rating = getAverage(ins_comments);
        }
        commentsList.loading = false;
        averageRating.loading = false;
    })
    .catch(exception => console.log(exception));
}

// Saca el promedio de calificaciones de todos los comentarios en una página
function getAverage(ins_comments) {

    let count = 0;
    for (let i = 0; i < ins_comments.length; i++) {
        count += parseInt(ins_comments[i].rating);
    }
    let average = parseFloat((count/ins_comments.length));
    return average.toFixed(2);

}

// Permite postear un comentario con calificación
function postComment(comment) {

    fetch('api/comment', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify(comment)
    })
    .then((response) => {

        console.log(response);
        if (response.ok) {
            alert('Your comment has been posted successfully.');
            getComments();
        } else {
            alert('Error posting comment.');
        }

    })
    .catch(exception => console.log(exception));

}

// Borra un comentario de la BD y de la API
function deleteComment(commentID) {

    fetch('api/comment/' + commentID, {method: 'DELETE'})
    .then((response) => {
        console.log(response);
        return response.text()
    })
    .then((response) => {

        if (response) {
            console.log(response);
            alert('The comment has been deleted successfully.');
        }
        else {
            console.log(response);
            alert('The comment could not be deleted.');
        }

    })
    .catch((exception) => console.log(exception));

}