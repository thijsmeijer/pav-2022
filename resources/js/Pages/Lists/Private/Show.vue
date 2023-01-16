<template>
    <Head :title="list.name" />
    <AuthenticatedLayout>
        <div
            class="w-full flex flex-col justify-center"
        >
            <div class="bg-[#2A1D5D] m-4 text-white font-bold p-2 px-4 rounded-md flex justify-between">
                <div class="flex">
                    <img
                        :src="list.thumbnail"
                        class="h-6 w-auto" alt="list thumbnail"
                    />
                    <span class="ml-2">
                        {{ list.name }}
                    </span>
                </div>
                <span>
                    {{ list.movies.length }} movies
                </span>
                <span
                    :class="listStatusColors[list.status]"
                    class="cursor-pointer"
                >
                    {{ list.status }}
                </span>
                <span
                    class="cursor-pointer"
                    @click.prevent="edit"
                >
                    edit list
                </span>
            </div>
            <div class="flex">
                <div class="w-1/2">
                    <div class="flex flex-col m-4">
                        <span class="bg-[#2A1D5D] text-white font-bold p-2 px-4 rounded-t-md">
                            Tagline
                        </span>
                        <span class="bg-white text-black font-bold p-2 px-4 rounded-b-md">
                            {{ list.excerpt }}
                        </span>
                    </div>
                    <div class="flex flex-col m-4">
                        <span class="bg-[#2A1D5D] text-white font-bold p-2 px-4 rounded-t-md">
                            Description
                        </span>
                        <span class="bg-white text-black font-bold p-2 px-4 rounded-b-md">
                            {{ list.description }}
                        </span>
                    </div>
                </div>
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
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Inertia} from "@inertiajs/inertia";
export default {
    name: "Show",
    components: {
        AuthenticatedLayout,
        Head
    },
    props: {
        list: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            listStatusColors: {
                'private': 'text-gray-400',
                'public': 'text-green-400',
            }
        }
    },
    methods: {
        edit() {
            Inertia.get(route('profile.lists.edit', this.list));
        }
    }
}
</script>
