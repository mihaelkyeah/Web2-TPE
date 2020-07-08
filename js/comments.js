'use strict';

// Se cargan los datos del usuario actual desde los elementos del HTML
let username = document.querySelector('#user').getAttribute('username');
let userID = document.querySelector('#user').getAttribute('id');
// let admin = document.querySelector('#user').getAttribute('user-admin');
// Sistema de privilegios improvisado para no tener que refactorizar toda la base de datos ahora...
let privilege = document.querySelector('#user').getAttribute('privilege');

var commentsList = new Vue({
    el: '#comments',
    data: {
        error: false,
        loading: false,
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
                    assessment.loading = true;
                    assessment.rating = null;
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
        }
    }
});

getComments();

function getComments() {

    let id = getInsID();

    fetch('api/comments/'+id)
    .then(response => response.json())
    .then(ins_comments => {
        if(ins_comments == null) {
            commentsList.error = true;
        }
        else {
            commentsList.ins_comments = ins_comments;
            assessment.rating = getAverage(ins_comments);
        }
        commentsList.loading = false;
        assessment.loading = false;
    })
    .catch(exception => console.log(exception));

}

function getInsID() {
    let url = window.location.pathname.split("/");
    let id = url[(url.length - 1)];
    return id;
}

function postComment(content, rating) {
    let id_ins = getInsID();

    let comment = {
        id_ins_fk: id_ins,
        id_user_fk: id_user,
        content: content,
        rating: rating
    };

    fetch('api/postComment', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify(comment)
    })
    .then((response) => {
        if (response.ok) {
            console.log('ok');
        } else {
            alert('Error posting comment.');
        }
    })
    .catch(exception => console.log(exception));
}

function getAverage(ins_comments) {
    let count = 0;
    for (let i = 0; i < ins_comments.length; i++) {
        count += parseInt(ins_comments[i].rating);
    }
    let average = parseFloat((count/ins_comments.length));
    return average.toFixed(2);
}