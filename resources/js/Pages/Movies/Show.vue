<template>
    {{ movie }}

</template>

<script>
export default {
    name: "Show",
    props: {
        movie: {
            type: Object,
            required: true
        }
    }
}
</script>
