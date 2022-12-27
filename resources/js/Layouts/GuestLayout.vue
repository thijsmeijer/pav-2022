<template>
    <div>
        <div class="min-h-screen">
            <nav class="sticky top-0 z-50 bg-blue-500">
                <div class="bg-white border-b border-gray-200 shadow">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between h-16 items-center">
                            <div class="flex">
                                <div class="shrink-0 flex items-center">
                                    <Link :href="route('dashboard')">
                                        <h1 class="text-xl font-bold text-gray-800">Dashboard</h1>
                                    </Link>
                                </div>
                            </div>

                            <div class="hidden sm:relative sm:space-x-6 sm:flex">
                                <Link :href="route('dashboard')" class="text-slate-800 hover:border-b-2"
                                      :class="{'border-b-2 border-blue-500': route().current('dashboard')}">Home

                                </Link>
                            </div>

                            <div class="hidden sm:flex sm:items-center sm:ml-6">
                                <div class="ml-3 relative" v-if="$page.props.auth.user">
                                    <div class="ml-3 relative">
                                        <Dropdown align="right" width="48">
                                            <template #trigger>
                                                <span class="inline-flex rounded-md">
                                                    <button type="button"
                                                            class="inline-flex items-center px-3 py-2 border border-transparent leading-4 font-medium rounded-md bg-white focus:outline-none transition ease-in-out duration-150">

                                                        <img :src="$page.props.avatar" class="h-8 w-8 rounded-full">
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
                                <!--             Hamburger button               -->
                                <button type="button"
                                        @click="toggleMenu"
                                        class="bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-400">
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
                <!--        Hamburger menu        -->
                <div v-if="showMenu" class="absolute shadow w-full border-b border-gray-200 z-50 bg-white md:hidden">
                    <div>
                        <div class="flex flex-col">
                            <Link :href="route('dashboard')"
                                  class="p-3 text-slate-800 border-r-4 font-semibold flex space-x-3"
                                  :class="{'border-blue-400': route().current('dashboard')}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                                </svg>
                                <span>Home</span>
                            </Link>
                            <span v-if="$page.props.auth.user">
                                <Link :href="route('profile.edit')"
                                      class="p-3 flex border-r-4 text-slate-800 space-x-3 font-semibold">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
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
                            </span>
                            <span v-else>
                                <Link :href="route('login')"
                                      class="p-3 text-blue-500 border-r-4 font-semibold flex space-x-3"
                                      :class="{'border-blue-400': route().current('login')}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/>
                                    </svg>
                                    <span>Log in</span>
                                </Link>
                            </span>
                        </div>
                    </div>
                </div>
            </nav>

            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header"/>
                </div>
            </header>

            <main>
                <slot/>
            </main>
        </div>
    </div>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';


export default {
    components: {Dropdown, DropdownLink, Link},
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
