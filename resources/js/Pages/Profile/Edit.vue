<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ user.username }}'s Profile</h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg flex items-center justify-center">
                    <UpdateProfileAvatarForm
                        :user="user"
                        :errors="errors"
                        :avatar="avatar"
                    />
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg flex items-center justify-center">
                    <UpdateProfileInformationForm
                        :user="user"
                        :errors="errors"
                        :avatar="avatar"
                    />
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg flex items-center justify-center">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg  flex items-center justify-center">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/inertia-vue3';
import UpdateProfileAvatarForm from "@/Pages/Profile/Partials/UpdateProfileAvatarForm.vue";

export default {
    components: {
        UpdateProfileAvatarForm,
        AuthenticatedLayout,
        DeleteUserForm,
        Head,
        UpdatePasswordForm,
        UpdateProfileInformationForm,
    },
    props: {
        user: {
            type: Object,
            required: true,
        },
        errors: {
            type: Object,
            required: false,
        },
        avatar: {
            type: String,
            required: false,
        },
    }
};
</script>
