<template>
    <div class="bg-[#2A1D5D] m-4 text-white font-bold p-2 px-4 rounded-md flex justify-between">
        <div
            class="flex cursor-pointer"
            @click="view"
        >
            <img
                :src="list.thumbnail"
                class="h-6 w-auto" alt="list thumbnail"
            />
            <span class="ml-2">
                {{ list.name }}
            </span>
        </div>
        <span>
            {{ list.movies.length }} movies
        </span>
        <span
            :class="listStatusColors[list.status]"
            class="cursor-pointer"
        >
            {{ list.status }}
        </span>
        <span
            v-show="page !== 'edit'"
            class="cursor-pointer"
            @click.prevent="edit"
        >
            edit list
        </span>
    </div>
</template>

<script>
import {Inertia} from "@inertiajs/inertia";

export default {
    name: "ListNav",
    props: {
        list: {
            type: Object,
            required: true
        },
        page: {
            type: String,
        }
    },
    data() {
        return {
            listStatusColors: {
                'private': 'text-gray-400',
                'public': 'text-green-400',
            }
        }
    },
    methods: {
        Inertia() {
            return Inertia
        },
        edit() {
            Inertia.get(route('profile.lists.edit', this.list));
        },
        view() {
            Inertia.get(route('profile.lists.show', this.list));
        }
    }
}
</script>
