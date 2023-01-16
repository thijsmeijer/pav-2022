<template>
    <Head title="Profile" />

    <AuthenticatedLayout
        @display-colors="displayColors"
        @hide-colors="hideColors"
    >
        <div class="z-10 inset-0">
            <div class="relative flex justify-start" :class="{ 'bg-[#2A1D5D]': colors }">
                <header class="relative py-10">
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <h1 class="text-3xl font-bold tracking-tight text-white hidden xl:flex">Settings</h1>
                    </div>
                </header>
            </div>
        </div>
        <div class="py-12 sm:-mt-24 z-0 relative">
            <div class="mx-auto max-w-4xl px-4 pb-6 sm:px-6 lg:px-8 lg:pb-16">
                <div class="overflow-hidden rounded-lg bg-white shadow">
                    <div class="lg:grid lg:grid-cols-12">
                        <div class="lg:col-span-9">
                            <div class="py-6 px-4 sm:p-6 lg:pb-8">
                                <div>
                                    <h2 class="text-lg font-medium leading-6 text-gray-900">Profile</h2>
                                </div>

                                <div class="mt-6 flex flex-col lg:flex-row">
                                    <div class="flex-grow space-y-6">
                                        <div>
                                            <InputLabel value="Username" />
                                            <TextInput
                                                type="text"
                                                class="my-1 block w-full"
                                                v-model="form.username"
                                                @input="form.validate('username')"
                                            />
                                            <InputError :message="form.errors.username" />
                                        </div>

                                        <div>
                                            <label for="about" class="block text-sm font-medium text-gray-700">About</label>
                                            <div class="mt-1">
                                                <textarea
                                                    id="about"
                                                    name="about"
                                                    rows="3"
                                                    class="my-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 sm:text-sm"
                                                    v-model="form.profile.about"
                                                />
                                                <InputError :message="form.errors.about" />

                                            </div>
                                            <p class="mt-2 text-sm text-gray-500">Brief description for your profile.</p>
                                        </div>
                                    </div>

                                    <div class="mt-6 flex-grow lg:mt-0 lg:ml-6 lg:flex-shrink-0 lg:flex-grow-0">
                                        <p class="text-sm font-medium text-gray-700">Avatar</p>
                                        <div class="mt-1 lg:hidden">
                                            <div class="flex items-center">
                                                <div class="inline-block h-12 w-12 flex-shrink-0 overflow-hidden rounded-full">
                                                    <img class="h-full w-full rounded-full" :src="avatarPreview || avatar" alt="" />
                                                </div>
                                                <div class="ml-5 rounded-md shadow-sm">
                                                    <div class="group relative flex items-center justify-center rounded-md border border-gray-300 py-2 px-3 focus-within:ring-2 focus-within:ring-sky-500 focus-within:ring-offset-2 hover:bg-gray-50">
                                                        <label for="mobile-user-photo" class="pointer-events-none relative text-sm font-medium leading-4 text-gray-700">
                                                            <span>Change</span>
                                                            <span class="sr-only"> user photo</span>
                                                        </label>
                                                        <input id="mobile-user-photo" name="user-photo" type="file" class="absolute h-full w-full cursor-pointer rounded-md border-gray-300 opacity-0" @change="uploadAvatar($event.target.files[0])"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="relative hidden overflow-hidden rounded-full lg:block">
                                            <img class="relative h-40 w-40 rounded-full" :src="avatarPreview || avatar" alt="" />
                                            <label for="desktop-user-photo" class="absolute inset-0 flex h-full w-full items-center justify-center bg-black bg-opacity-75 text-sm font-medium text-white opacity-0 focus-within:opacity-100 hover:opacity-100">
                                                <span>Change</span>
                                                <span class="sr-only"> user photo</span>
                                                <input type="file" id="desktop-user-photo" name="user-photo" class="absolute inset-0 h-full w-full cursor-pointer rounded-md border-gray-300 opacity-0" @change="uploadAvatar($event.target.files[0])" />
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6 grid grid-cols-12 gap-6">
                                    <div class="col-span-12 sm:col-span-6">
                                        <div>
                                            <InputLabel value="Name" />
                                            <TextInput
                                                type="text"
                                                class="my-1 block w-full"
                                                v-model="form.profile.name"
                                            />
                                            <InputError :message="form.errors.name" />
                                        </div>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <div>
                                            <InputLabel value="Email" />
                                            <TextInput
                                                type="email"
                                                class="my-1 block w-full"
                                                v-model="form.email"
                                                @input="form.validate('email')"
                                            />
                                            <InputError :message="form.errors.email" />
                                        </div>
                                        <div v-if="!user.email_verified_at">
                                            <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                                Your email address is unverified.
                                                <button
                                                    type="button"
                                                    class="text-indigo-600 hover:text-indigo-500 cursor-pointer"
                                                    @click.prevent="sendVerificationEmail"
                                                >
                                                    Click here to re-send the verification email.
                                                </button>
                                            </p>
                                            <div
                                                v-show="status === 'verification-link-sent'"
                                                class="mt-2 font-medium text-sm text-green-600 dark:text-green-400"
                                            >
                                                A new verification link has been sent to your email address.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <PrimaryButton
                            class="ml-4 mb-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            @click.prevent="saveProfileInformation"
                        >
                            Save
                        </PrimaryButton>

                        <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                            <p v-if="form.recentlySuccessful" class="text-sm text-green-400">Profile Saved.</p>
                        </Transition>

                        <p v-if="form.isDirty || avatarForm.isDirty" class="text-sm text-red-400">Unsaved Changes.</p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import InputLabel from "@/Components/FormElements/InputLabel.vue";
import TextInput from "@/Components/FormElements/TextInput.vue";
import {Inertia} from "@inertiajs/inertia";
import {usePrecognitiveForm} from "laravel-precognition-vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import InputError from "@/Components/FormElements/InputError.vue";

export default {
    components: {
        InputError,
        PrimaryButton,
        TextInput,
        InputLabel,
        AuthenticatedLayout,
        DeleteUserForm,
        Head,
        UpdatePasswordForm,
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
    },
    setup(props) {
        const form = usePrecognitiveForm('patch', route('profile.update'), useForm({
            username: props.user.username,
            email: props.user.email,
            profile: {
                name: props.user.profile.name,
                about: props.user.profile.about,
            },
        }));

        const avatarForm = useForm({
            avatar: null
        })

        return {
            form, avatarForm
        };
    },
    data () {
        return {
            status: null,
            avatarPreview: null,
            colors: true,
        };
    },
    methods: {
        sendVerificationEmail() {
            Inertia.post(route('email.verification.send'), {}, {
                preserveScroll: true,
                onSuccess: () => {
                    this.status = 'verification-link-sent';
                },
            });
        },
        saveProfileInformation() {
            this.form.patch(route('profile.update'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.saveAvatar();
                }
            });
        },
        uploadAvatar(file) {
            this.avatarForm.avatar = file;
        },
        saveAvatar() {
            this.avatarForm.post(route('profile.avatar.update'), {
                preserveScroll: true,
            });
        },
        displayColors() {
            this.colors = true;
        },
        hideColors() {
            this.colors = false;
        },
    },
    watch: {
        'avatarForm.avatar': function (file) {
            if (file) {
                this.avatarPreview = URL.createObjectURL(file);
            }
        },
    },
};
</script>
