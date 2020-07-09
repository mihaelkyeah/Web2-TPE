{literal}
<section id="averageRating">

    <br>
    <div v-if="loading">
        <p>Loading average rating...</p>
    </div>

    <div v-if="!loading">
        <div v-if="users_rating">
            <div>
                <h3>Average user rating:</h3>
                <h2>{{users_rating}}</h2>
            </div>
        </div>
        <div v-if="!users_rating">
            <p>There are no ratings for this instrument yet.</p>
        </div>
    </div>

</section>
{/literal}