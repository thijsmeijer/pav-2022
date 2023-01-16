<template>
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
</template>

<script>
export default {
    name: "ListInfo",
    props: {
        list: {
            type: Object,
            required: true
        }
    }
}
</script>
