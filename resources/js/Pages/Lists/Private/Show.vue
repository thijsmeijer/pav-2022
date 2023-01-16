<template>
    <Head :title="list.name" />
    <AuthenticatedLayout>
        <div
            class="w-full flex flex-col justify-center"
        >
            <ListNav :list="list" />
            <div class="flex flex-col lg:flex-row">
                <ListInfo :list="list" class="w-full lg:w-1/2"/>
                <ListMovies :list="list" class="w-full lg:w-1/2" :flash="flash"/>
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
import FlashSuccessMessage from "@/Components/FlashMessages/FlashSuccessMessage.vue";
export default {
    name: "Show",
    components: {
        FlashSuccessMessage,
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
        },
        flash: Object,
    },
}
</script>
