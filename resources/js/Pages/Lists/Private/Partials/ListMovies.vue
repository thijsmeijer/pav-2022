<template>
    <div class="w-1/2">
        <div
            v-for="movie in list.movies"
            class="bg-white rounded-md shadow-xl m-2 flex justify-between cursor-pointer"
        >
            <img
                :src="movie.poster_path"
                class="h-32 sm:h-40 w-auto rounded-l-md" alt="movie poster"
            />
            <h2 class="text-lg font-medium leading-none text-slate-500 mb-4 px-4 py-5 flex flex-col">
                {{ movie.title }}
                <span class="text-slate-400">
                    {{ movie.excerpt }}
                </span>
            </h2>
        </div>
    </div>
</template>

<script>
export default {
    name: "ListMovies",
    props: {
        list: {
            type: Object,
            required: true
        }
    }
}
</script>
