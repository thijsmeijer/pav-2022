<template>
    <Head :title="list.name" />
    <AuthenticatedLayout>
        <div class="py-10">
            <div class="w-full bg-gray-100 flex">
                <div class="w-full md:w-1/3">
                    <div class=" flex flex-col justify-center items-center">
                        <img :src="list.thumbnail" class="w-1/2 md:w-full xl:w-2/3 h-64 flex items-center justify-center" alt="list thumbnail" />
                        <h2 class="flex items-center justify-center font-bold text-xl">
                            {{ list.name }}
                        </h2>
                        <p class="px-8">{{ list.description }}</p>
                        <p class="font-bold text-amber-400">{{ list.status }}</p>
                        <button
                            class="flex items-center justify-center w-full md:w-1/3 bg-amber-400 text-white font-bold py-2 px-4 rounded"
                            @click.prevent="edit"
                        >
                            Edit
                        </button>
                    </div>

                </div>

                <div class="hidden md:flex w-2/3">

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
    methods: {
        edit() {
            Inertia.get(route('profile.lists.edit', this.list));
        }
    }
}
</script>
