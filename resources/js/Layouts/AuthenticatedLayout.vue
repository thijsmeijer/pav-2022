<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <AuthNav />

            <main>
                <slot class="max-w-7xl mx-auto px-4 lg:px-8"/>
            </main>
        </div>
    </div>
</template>

<script>
import AuthNav from "@/Layouts/Partials/Auth/Nav.vue";

export default {
    name: 'AuthenticatedLayout',
    components: {
        AuthNav,
    },
}
</script>
