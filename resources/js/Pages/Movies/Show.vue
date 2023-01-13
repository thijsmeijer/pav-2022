<template>
    <Head :title="movie.title" />
    <AuthenticatedLayout>
        <div class="mx-auto max-w-4xl px-4 pb-6 sm:px-6 lg:px-8 lg:pb-16 mt-4">
            <div class="space-y-4 mb-4">
                <FlashSuccessMessage
                    class="rounded-md bg-green-50 p-4"
                    v-if="flash.success"
                    :message="flash.success"
                />

                <div class="flex justify-between items-center">
                    <PreviousPageLink
                        class="hidden md:block"
                        :previous-url="previousUrl"
                    />
                    <Menu as="div" class="relative inline-block text-left">
                        <div>
                            <MenuButton
                                class="inline-flex items-center px-4 py-2 bg-amber-400 border border-transparent rounded-md font-bold text-xs text-black uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            >
                                Add to list
                                <ChevronDownIcon
                                    class="ml-2 -mr-1 h-5 w-5 text-black font-bold"
                                    aria-hidden="true"
                                />
                            </MenuButton>
                        </div>

                        <transition
                            enter-active-class="transition duration-100 ease-out"
                            enter-from-class="transform scale-95 opacity-0"
                            enter-to-class="transform scale-100 opacity-100"
                            leave-active-class="transition duration-75 ease-in"
                            leave-from-class="transform scale-100 opacity-100"
                            leave-to-class="transform scale-95 opacity-0"
                        >
                            <MenuItems
                                class="absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            >
                                <div
                                    class="px-1 py-1"
                                    v-for="list in $page.props.user.lists"
                                >
                                    <MenuItem v-slot="{ active }">
                                        <button
                                            :class="[
                                                      active ? 'bg-violet-500 text-white' : 'text-gray-900',
                                                      'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                                    ]"
                                            @click="addToList(list)"
                                        >
                                            {{ list.name }}
                                        </button>
                                    </MenuItem>
                                </div>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>
            </div>
            <div class="flex bg-white">
                <div class="w-1/2">
                    <img
                        :src="movie.poster"
                        class="h-[624px]"
                        alt=""
                    />
                </div>
                <div class="flex flex-col w-1/2">
                    <div class="flex flex-col justify-center py-4 items-center">
                        <span class="font-bold text-lg">
                            {{ movie.title }}
                        </span>
                        <span class="font-medium text-sm">
                            {{ movie.tagline }}
                        </span>
                    </div>
                    <div class="px-4 h-full flex flex-col justify-between">
                        <div>
                            <span>
                                {{ movie.overview }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <StarRating :rating="rating" />
                            <span>
                                {{ movie.release_date }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import FlashSuccessMessage from "@/Components/FlashSuccessMessage.vue";
import PreviousPageLink from "@/Components/PreviousPageLink.vue";
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/20/solid'
import StarRating from "@/Components/StarRating.vue";

export default {
    name: "Show",
    components: {
        StarRating,
        PrimaryButton,
        AuthenticatedLayout,
        Head,
        FlashSuccessMessage,
        PreviousPageLink,
        Menu,
        MenuButton,
        MenuItems,
        MenuItem,
        ChevronDownIcon,
    },
    props: {
        movie: {
            type: Object,
            required: true
        },
        flash: Object,
        previousUrl: String,
    },
    setup(props) {
        const form = useForm({
            tmdb_id: props.movie.id,
            title: props.movie.title,
            poster_path: props.movie.poster,
            tagline: props.movie.tagline,
            overview: props.movie.overview,
            rating: props.movie.vote_average,
            release_date: props.movie.release_date,
        });

        const rating = Math.round(props.movie.vote_average * 10) / 10;

        return {
            form,
            rating,
        };
    },
    methods: {
        addToList(list) {
            this.form.post(route('lists.movie.store', {list: list}), {
                preserveScroll: true,
                preserveState: false,
            });
        }
    }
}
</script>
