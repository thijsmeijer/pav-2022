<template>
    <div>
        <FlashSuccessMessage :message="flash.success"/>

        <div
            v-for="movie in list.movies"
            class="bg-white rounded-md shadow-xl m-2 flex justify-between items-center cursor-pointer"
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
            <TrashIcon
                class="h-5 w-5 text-red-500 cursor-pointer mr-4"
                @click.prevent="removeMovie(movie)"
            />
        </div>
    </div>
</template>

<script>
import {TrashIcon} from "@heroicons/vue/20/solid";
import {Inertia} from "@inertiajs/inertia";
import FlashSuccessMessage from "@/Components/FlashMessages/FlashSuccessMessage.vue";
export default {
    name: "ListMovies",
    components: {
        FlashSuccessMessage,
        TrashIcon
    },
    props: {
        list: {
            type: Object,
            required: true
        },
        flash: {
            type: Object,
        }
    },
    methods: {
        removeMovie(movie) {
            Inertia.delete(route('lists.movie.destroy', {
                list: this.list.slug,
                movie: movie.id
            }))
        }
    }
}
</script>
