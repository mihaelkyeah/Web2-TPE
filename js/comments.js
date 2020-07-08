'use strict';

// Se cargan los datos del usuario actual desde los elementos del HTML
let username = document.querySelector('#user').getAttribute('username');
let userID = document.querySelector('#user').getAttribute('id');
let admin = document.querySelector('#user').getAttribute('admin');

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
         * Eliminar un comentario por id (del comentario)
         */
        deleteComment: function (id) {
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
})