<template>
    <Head title="Lists"/>

    <AuthenticatedLayout>
        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    <button
                        class="cursor-pointer overflow-hidden rounded-md m-2 flex  border-dashed border-2 border-gray-300 items-center text-gray-300 hover:text-black"
                        type="submit"
                        @click.prevent="create"
                    >
                        <span class="block w-full flex flex-wrap justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        <span class="font-bold block w-full">Create a new list</span>
                        </span>
                    </button>
                    <div v-for="list in user.lists"
                         :key="list.id"
                         class="overflow-hidden rounded-md shadow-xl m-2 flex flex-col justify-between cursor-pointer"
                         @click.prevent="view(list)">
                        <div>
                            <img
                                :src="list.thumbnail"
                                class="h-32 sm:h-40 w-full" alt="list thumbnail"
                            />
                            <h2 class="text-lg font-medium leading-none text-slate-500 mb-4 px-4 py-5">
                                {{ list.name }}
                                <span class="block text-sm text-slate-400">{{ list.excerpt }}</span>
                            </h2>
                        </div>
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
    name: "Index",
    components: {
        AuthenticatedLayout,
        Head
    },
    props: {
        user: {
            type: Object,
            required: true
        }
    },
    methods: {
        create() {
            Inertia.get(route('lists.create'));
        },
        view(list) {
            Inertia.get(route('profile.lists.show', {list: list}));
        }
    }
}
</script>
