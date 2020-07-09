'use strict';

// Se cargan los datos del usuario actual desde los elementos del HTML
let username = document.querySelector('#commentSection').getAttribute('username');
let userID = document.querySelector('#commentSection').getAttribute('id');
let insID = document.querySelector('#commentSection').getAttribute('insID')
let privilege = document.querySelector('#commentSection').getAttribute('privilege');

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
        deleteComment: function (insID) {
            fetch('api/deleteComment/' + insID, {method: 'DELETE'})
            .then((response) => {
                console.log(response);
                return response.text()
            })
            .then((response) => {

                // Desde la API se recibe un string que dice 'true'
                if (response) {
                    console.log(response);
                }
                else {
                    console.log(response);
                    // alert(response);
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
         */
        postComment: function(e) {

            e.preventDefault(e);
            // postComment(userComment.value, rating.value);
            let comment = {
                id_ins_fk: insID,
                id_user_fk: userID,
                content: userComment.value,
                rating: rating.value
            };
        
            fetch('api/comment/post', {
                method: 'POST',
                headers: {'Content-Type':'application/json'},
                body: JSON.stringify(comment)
            })
            .then((response) => {
                console.log(response);
                if (response.ok) {
                    console.log('ok');
                } else {
                    alert('Error posting comment.');
                }
            })
            .catch(exception => console.log(exception));

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

function getAverage(ins_comments) {
    let count = 0;
    for (let i = 0; i < ins_comments.length; i++) {
        count += parseInt(ins_comments[i].rating);
    }
    let average = parseFloat((count/ins_comments.length));
    return average.toFixed(2);
}