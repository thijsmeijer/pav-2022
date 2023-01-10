<template>
    <div class="overflow-hidden rounded-md shadow-xl flex flex-col h-90">
        <div class="bg-gray-900">
            <img
                :src="movie.poster"
                class="h-auto w-full"
                alt=""
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
</template>

<script>
export default {
    name: "MovieCard",
    props: {
        movie: {
            type: Object,
            required: true
        }
    }
}
</script>
