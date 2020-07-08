'use strict';

// Se cargan los datos del usuario actual desde los elementos del HTML
let username = document.querySelector('#user').getAttribute('username');
let userID = document.querySelector('#user').getAttribute('id');
let admin = document.querySelector('#user').getAttribute('admin');
// Sistema de privilegios improvisado para no tener que refactorizar toda la base de datos ahora...
let privilege = document.querySelector('#user').getAttribute('privilege');

var commentsList = new Vue({
    el: '#comments',
    data: {
        error: false,
        loading: false,
        admin: admin,
        ins_comments: []
    },
    methods: {
        /**
         * Elimina un comentario por id
         */
        deleteComment: function (id) {
            // original:
            // fetch('library/api/deleteComment/' + id, { method: 'DELETE' })
            fetch('corador/api/deleteComment' + id, {method: 'DELETE'})
            .then((response) => { return response.text()})
            .then((response) => {

                // Desde la API se recibe un string que dice 'true'
                if (response == 'true') {
                    assessmentment.loading = true;
                    assessment.rating = null;

                    setTimeout(function(){ getComments() }, 500);
                }
                else {
                    alert(response);
                }

            })
            .catch((exception) => console.log(exception));
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
        
        /**
         * Permite postear un comentario con puntaje
         * @param {*} e evento submit recarga la página por defecto
         */
        checkForm: function(e) {
            // Evita reload
            e.preventDefault();

            postComment(userComment.value, rating.value);

            commentsList.error = false;
            commentsList.loading = true;
            commentsList.ins_comments = [];
            formPostComment.userComment = null;
            formPostComment.rating = null;

            setTimeout(function(){getComments()}, 1000);

        }
        
    }
});

getComments();