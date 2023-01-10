<template>
    <nav class="sticky top-0 z-50 bg-blue-500">
        <div class="bg-[#2A1D5D] border-b border-gray-200 shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="shrink-0 flex items-center">
                            <Link :href="route('home')">
                                <ApplicationLogoWhite class="block h-9 w-auto fill-current"/>
                            </Link>
                        </div>

                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <Link
                                class="flex justify-center items-center text-white hover:text-amber-400 font-bold"
                                :class="{'text-amber-400': route().current('movies.index')}"
                                :href="route('movies.index')"
                            >
                                Movies
                            </Link>
                            <Link
                                v-show="$page.props.user"
                                class="flex justify-center items-center text-white hover:text-amber-400 font-bold"
                                :class="{'text-amber-400': route().current('profile.lists')}"
                                :href="route('profile.lists')"
                            >
                                Lists
                            </Link>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="ml-3 relative" v-if="$page.props.user">
                            <div class="ml-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                                <span class="inline-flex rounded-md">
                                                    <button
                                                        type="button"
                                                        class="inline-flex items-center px-3 py-2 border border-transparent leading-4 font-medium rounded-md focus:outline-none transition ease-in-out duration-150"
                                                    >
                                                        <img :src="$page.props.avatar" class="h-8 w-8 rounded-full" alt="">
                                                    </button>
                                                </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')"
                                                      class="flex items-center space-x-2">
                                            <img :src="$page.props.avatar" class="h-4 w-4 rounded-full">
                                            <span>Profile</span>
                                        </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button"
                                                      class="text-red-500 flex items-center space-x-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                 class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                                            </svg>
                                            <span>Log out</span>
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>
                        <div class="ml-3 relative" v-else>
                            <Link :href="route('login')" class="text-blue-500 flex space-x-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/>
                                </svg>

                                <span>Log in</span>
                            </Link>
                        </div>
                    </div>

                    <div class="sm:hidden">
                        <button type="button"
                                @click="toggleMenu"
                                class="bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-400 mt-3">
                            <span class="sr-only">Open main menu</span>
                            <svg v-if="!showMenu" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            <svg v-if="showMenu" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <HamburgerMenu v-if="showMenu" class="absolute shadow w-full border-b border-gray-200 z-50 bg-white md:hidden" />
    </nav>
</template>

<script>
import HamburgerMenu from "@/Layouts/Partials/Guest/HamburgerMenu.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import {Link} from "@inertiajs/inertia-vue3";
import ApplicationLogoWhite from "@/Components/ApplicationLogoWhite.vue";

export default {
    name: "GuestNav",
    components: {ApplicationLogoWhite, HamburgerMenu, Dropdown, DropdownLink, Link},
    data() {
        return {
            showMenu: false
        }
    },
    methods: {
        toggleMenu() {
            this.showMenu = !this.showMenu;
        }
    }
}
</script>
