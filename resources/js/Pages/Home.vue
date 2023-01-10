<template>
    <Head title="Home" />
    <GuestLayout>
        <div class="max-w-6xl mx-6 mt-10 lg:mx-auto">
            <div>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg sm:text-xl md:text-2xl font-semibold">title</h2>
                    <a
                        class="bg-amber-400 text-black px-3 py-1 rounded-full hover:bg-blue-700 hover:text-white duration-100 font-semibold cursor-pointer"
                    >
                        See all
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
                    <div v-for="movie in movies" :key="movie.id" class="flex items-stretch">
                        <div
                            class="overflow-hidden rounded-md shadow-xl flex flex-col"
                        >
                            <div class="relative bg-gray-900">
                                <img
                                    v-if="movie.poster_path"
                                    :src=getImgUrl(movie.poster_path)
                                    class="h-auto w-full"
                                    alt="Movie poster"
                                />
                            </div>
                            <div class="flex flex-col justify-between p-5 h-full">
                                <div>
                                    <h2 class="text-lg font-medium leading-none text-slate-500 mb-4">
                                        {{ movie.original_title }}
                                    </h2>
                                </div>
                                <div class="space-y-0.5">
<!--                                    <view-project-button :project-slug="project"/>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";

export default {
    name: "Home",
    components: {
        GuestLayout,
        Head
    },
    props: {
        movies: {
            type: Array,
            required: true
        }
    },
    methods: {
        getImgUrl: function (path) {
            return "https://image.tmdb.org/t/p/original/" + path;
        }
    }
}
</script>
