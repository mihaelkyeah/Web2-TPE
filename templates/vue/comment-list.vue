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
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Rating</th>
                    <th scope="col">Comment</th>
                    <th scope="col">User</th>
                    <th v-if="privilege == 2" scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="comment in ins_comments">
                    <th  scope="row">{{comment.rating}}</td>
                    <td>{{comment.content}}</td>
                    <td>{{comment.username}}</td>
                    <td v-if="privilege == 2">
                        <button v-on:click="removeComment(comment.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

</section>
{/literal}