<template>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
        <MovieCard
            v-for="movie in movies"
            :key="movie.id"
            :movie="movie"
            class="flex items-stretch"
        />
    </div>
</template>

<script>
import MovieCard from "@/Components/MovieCard.vue";

export default {
    name: "MovieGrid",
    components: {MovieCard},
    props: {
        movies: {
            type: Array,
            required: true
        }
    }
}
</script>
