<template>
    <Head title="Search" />
    <GuestLayout>
        <div class="max-w-6xl mx-6 mt-10 lg:mx-auto">
            <div>
                <div class="my-10 grid grid-cols-6 gap-4">
                    <div class="relative mt-1 flex items-center col-span-6 sm:col-span-4">
                        <input
                            v-model="form.search"
                            @input="search"
                            type="text" name="search" id="search"
                            placeholder="Search for a movie..."
                            class="block w-full rounded-md border-gray-300 pr-12 shadow-sm focus:border-blue-400 focus:ring-blue-400 sm:text-sm">
                        <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 text-slate-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
                    <div v-for="movie in movies" :key="movie.id" class="flex items-stretch">
                        <div
                            class="overflow-hidden rounded-md shadow-xl flex flex-col"
                        >
                            <div class="relative bg-gray-900">
                                <img
                                    v-if="movie.poster"
                                    :src="movie.poster"
                                    class="h-auto w-full"
                                    alt="Movie poster"
                                />
                            </div>
                            <div class="flex flex-col justify-between p-5 h-full">
                                <div>
                                    <h2 class="text-lg font-medium leading-none text-slate-500 mb-4">
                                        {{ movie.title }}
                                    </h2>
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
import {Head, useForm} from "@inertiajs/inertia-vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";

export default {
    name: "Search",
    components: {
        GuestLayout,
        Head
    },
    props: {
        movies: {
            type: Array,
            required: true
        },
        search: {
            type: String,
            required: true
        }
    },
    setup(props) {
        const form = useForm({
            search: props.search || '',
        });

        const search = () => {
            form.get(route('search'), {
                preserveState: true,
                onSuccess: (page) => {

                },
            });
        };

        return {
            form,
            search,
        };
    }
}
</script>
