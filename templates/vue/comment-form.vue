{literal}
<section id="comment-form">

    <div v-if="privilege == 0">
        <h4>You must be logged in to comment.</h4>
    </div>
    <div v-else>
        <h4>Post your comment:</h4>
        <form @submit="sendComment" method="POST">
            <div class="col-auto my-1">
                <textarea v-model="userComment" class="formControl" rows="5" cols="80" style="resize:none" id="userComment" placeholder="Write your comment here..." required></textarea>
            </div>
            <div class="form-row align-items-center">
                <div class="col-auto my-1">
                    <label for="rating">Rating:</label>
                </div>
                <div class="col-auto my-1">
                    <select v-model="rating" class="custom-select mr-sm-2" id ="rating">
                        <option value="5">5</option>
                        <option value="4">4</option>
                        <option value="3">3</option>
                        <option value="2">2</option>
                        <option value="1">1</option>
                    </select>
                </div>
                <div class= "col-auto my-1">
                    <input type="submit" class="btn btn-warning" value="Post comment">
                </div>
            </div>
        </form>
    </div>

</section>
{/literal}