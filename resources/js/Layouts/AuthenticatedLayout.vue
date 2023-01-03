<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-[#2A1D5D]">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                    <ApplicationLogoWhite
                                        class="block h-9 w-auto fill-current"
                                    />
                                </Link>
                            </div>

                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <Link
                                    class="flex justify-center items-center text-white hover:text-amber-400 font-bold"
                                    :class="{'text-amber-400': route().current('profile.lists')}"
                                    :href="route('profile.lists')"
                                    >
                                    Lists
                                </Link>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <div class="ml-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium
                                                 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                <img class="h-8 w-8 rounded-full border" :src="$page.props.avatar" alt="" />
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                v-on:click="HamburgerTouched"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden bg-white"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('profile.lists')" :active="route().current('profile.lists')">
                            Lists
                        </ResponsiveNavLink>
                    </div>

                    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                                {{ $page.props.user.username }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <Link :href="route('profile.edit')"
                                  class="p-3 flex border-r-4 text-slate-800 space-x-3 font-semibold">
                                <img :src="$page.props.avatar" class="w-6 h-6 rounded-full border">
                                <span>Profile</span>
                            </Link>
                            <Link :href="route('logout')" method="post"
                                  class="p-3 flex border-r-4 text-red-400 space-x-3 font-semibold">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                                </svg>
                                <span>Log out</span>
                            </Link>
                        </div>
                    </div>
                </div>
            </nav>

            <header class="bg-white dark:bg-gray-800 shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <main>
                <slot class="max-w-7xl mx-auto px-4 lg:px-8"/>
            </main>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/inertia-vue3';
import ApplicationLogoWhite from "@/Components/ApplicationLogoWhite.vue";

export default {
    name: 'AuthenticatedLayout',
    components: {
        ApplicationLogoWhite,
        Dropdown,
        DropdownLink,
        NavLink,
        ResponsiveNavLink,
        Link
    },
    setup() {
        const showingNavigationDropdown = ref(false);

        return { showingNavigationDropdown }
    },
    methods: {
        HamburgerTouched() {
            this.showingNavigationDropdown = !this.showingNavigationDropdown;

            if (this.showingNavigationDropdown) {
                this.$emit('hide-colors');
            } else {
                this.$emit('display-colors');
            }
        }
    }
}
</script>
