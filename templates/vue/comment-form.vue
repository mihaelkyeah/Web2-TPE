{literal}
<section id="comment-form">

    <div v-if="privilege == 0">
        <h4>You must be logged in to comment.</h4>
    </div>
    <div v-else>
        <h4>Post your comment:</h4>
        <form @submit="sendComment" method="POST">
            <div>
                <textarea v-model="userComment" rows="4" cols="75" style="resize:none" id="userComment" placeholder="Write your comment here..." required></textarea>
            <div>
            <div>
                <input type="number" v-model="rating" id ="rating" min=1 max=5 placehoder="Rating" required>
                <input type="submit" value="Post comment">
            </div>
        </form>
    </div>

</section>
{/literal}