<template>
    <Head :title="list.name" />
    <AuthenticatedLayout>
        <div
            class="w-full flex flex-col justify-center"
        >
            <ListNav :list="list" />
            <div class="flex">
                <ListInfo :list="list" />
                <ListMovies :list="list" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ListNav from "@/Pages/Lists/Private/Partials/ListNav.vue";
import ListMovies from "@/Pages/Lists/Private/Partials/ListMovies.vue";
import ListInfo from "@/Pages/Lists/Private/Partials/ListInfo.vue";
export default {
    name: "Show",
    components: {
        ListInfo,
        ListMovies,
        ListNav,
        AuthenticatedLayout,
        Head
    },
    props: {
        list: {
            type: Object,
            required: true
        }
    }
}
</script>
