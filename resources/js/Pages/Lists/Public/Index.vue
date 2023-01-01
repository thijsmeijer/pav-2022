<template>
    <Head title="Lists"/>

    <GuestLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ profile.username }}'s lists
                </h2>
            </div>
        </template>
        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    <div v-for="list in profile.lists"
                         class="overflow-hidden rounded-md shadow-xl m-2 flex flex-col justify-between">
                        <div>
                            <img
                                :src="list.thumbnail"
                                class="h-auto w-full" alt="Restaurant"
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
    </GuestLayout>

</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import GuestLayout from "@/Layouts/GuestLayout.vue";


export default {
    name: "Lists",
    components: {
        GuestLayout,
        Head
    },
    props: {
        profile: {
            type: Object,
            required: true
        }
    }
}
</script>
