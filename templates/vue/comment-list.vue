{literal}
<section id="comments">

<div v-if="loading">
    <p>Loading comments...</p>
</div>

<div v-if="!loading">
    <div v-if="error">
        <p>There are no comments on this instrument yet. Soyez le premier!</p>
    </div>
    <div v-if="!error">
        <table>
            <thead>
                <tr>
                    <th>Comment</th>
                    <th>Rating</th>
                    <th>User</th>
                    <!-- Prioridad de administrador
                    TODO: Implementar a mi manera -->
                    <!-- <th v-if="priority == 2"></th> -->
                </tr>
            </thead>
            <tbody>
                <tr v-for="comment in ins_comments">
                    <td class="text-size">{{comment.content}}</td>
                    <td>{{comment.rating}}</td>
                    <td>{{comment.username}}</td>
                    <td v-if="privilege == 2">
                        <button v-on:click="deleteComment(comment.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

</section>
{/literal}