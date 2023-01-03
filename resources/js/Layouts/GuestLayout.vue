<template>
    <div>
        <div class="min-h-screen">
            <GuestNav />

            <main>
                <slot/>
            </main>
        </div>
    </div>
</template>

<script>

import GuestNav from "@/Layouts/Partials/Guest/Nav.vue";

export default {
    name: "GuestLayout",
    components: {
        GuestNav
    }
}
</script>
