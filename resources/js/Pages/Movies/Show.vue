<template>
    <Head :title="movie.title" />
    <AuthenticatedLayout>
        <div class="mx-auto max-w-4xl px-4 pb-6 sm:px-6 lg:px-8 lg:pb-16 mt-4">
            <div class="flex bg-white">
                <div class="w-1/2">
                    <img
                        :src="movie.poster"
                        class="h-[624px]"
                        alt=""
                    />
                </div>
                <div class="flex flex-col w-1/2">
                    <div class="flex flex-col justify-center py-4 items-center">
                        <span class="font-bold text-lg">
                            {{ movie.title }}
                        </span>
                        <span class="font-medium text-sm">
                            {{ movie.tagline }}
                        </span>
                    </div>
                    <div class=" px-4 h-full flex flex-col justify-between">
                        <div>
                            <span>
                                {{ movie.overview }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span>
                                {{ round(movie.vote_average) }}
                            </span>
                            <span>
                                {{ movie.release_date }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

export default {
    name: "Show",
    components: {
        AuthenticatedLayout,
        Head
    },
    props: {
        movie: {
            type: Object,
            required: true
        }
    },
    methods: {
        round(value) {
            return Math.round(value * 10) / 10;
        }
    }
}
</script>
