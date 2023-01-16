<template>
    <Head title="Home" />

    <GuestLayout>
        <div class="max-w-6xl mx-6 mt-10 lg:mx-auto">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg sm:text-xl md:text-2xl font-semibold">Popular movies</h2>
                <a
                    :href="route('movies.index')"
                    class="bg-amber-400 text-black px-3 py-1 rounded-full hover:bg-blue-700 hover:text-white duration-100 font-semibold cursor-pointer"
                >
                    See all movies
                </a>
            </div>

            <MovieGrid :movies="movies" />
        </div>
    </GuestLayout>
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import MovieGrid from "@/Components/Movies/MovieGrid.vue";

export default {
    name: "Home",
    components: {
        MovieGrid,
        GuestLayout,
        Head
    },
    props: {
        movies: {
            type: Array,
            required: true
        }
    }
}
</script>
