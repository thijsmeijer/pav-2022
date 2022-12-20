<template>
    <section>
        <div class="space-y-8">
            <div class="space-y-8">
                <div>
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Profile</h3>
                        <p class="mt-1 text-sm text-gray-500">This information will be displayed publicly so be careful what you share.</p>
                    </div>
                    <div class="flex items-center">
                        <div class="mt-6 w-10 h-10 rounded-full mr-4 mb-4">
                            <div>
                                <img class="w-10 h-10 rounded-full bg-gray-200 border-2" :src="avatarPreview || avatar" alt="profile_image">
                            </div>
                        </div>
                        <div class="flex items-center relative cursor-pointer rounded-md font-medium text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:text-indigo-500">
                            <input type="file" @change="uploadAvatarPreview($event.target.files[0])"/>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                            @click.prevent="updateAvatar"
                            :disabled="avatarForm.processing"
                            :class="{'opacity-50 cursor-not-allowed': avatarForm.processing}"
                        >
                            Save avatar
                        </button>

                        <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                            <p v-if="avatarForm.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Saved.</p>
                        </Transition>
                    </div>

                    <div>
                        <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <div>
                                    <TextInput
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.name"
                                        @input="delete errors.name && form.validate('name')"
                                    />
                                </div>
                                <InputError class="mt-2" :message="errors.name || form.errors.name" />
                            </div>

                            <div class="sm:col-span-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <div>
                                    <TextInput
                                        id="email"
                                        type="email"
                                        class="mt-1 block w-full"
                                        v-model="form.email"
                                        @input="delete errors.email && form.validate('email')"
                                    />
                                </div>
                                <InputError class="mt-2" :message="errors.email || form.errors.email" />
                            </div>
                        </div>
                        <div v-if="!user.email_verified_at">
                            <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                Your email address is unverified.
                                <button
                                    type="button"
                                    class="text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300"
                                    @click.prevent="sendVerificationEmail"
                                >
                                    Click here to send the verification email.
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
                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                        <div class="sm:col-span-4">
                            <label for="dob" class="block text-sm font-medium text-gray-700">Date of birth</label>
                            <div>
                                <TextInput
                                    id="dob"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.date_of_birth"
                                    @input="delete errors.date_of_birth && form.validate('date_of_birth')"
                                />
                            </div>
                            <InputError class="mt-2" :message="errors.date_of_birth || form.errors.date_of_birth" />
                        </div>

                        <div class="sm:col-span-4">
                            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-gray-500 sm:text-sm">pav.com/</span>
                                <input
                                    id="username"
                                    type="text"
                                    class="w-full block w-full rounded-r-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    v-model="form.username"
                                    @input="delete errors.username && form.validate('username')"
                                />
                            </div>
                            <InputError class="mt-2" :message="errors.username || form.errors.username" />
                        </div>

                        <div class="sm:col-span-6">
                            <label for="about" class="block text-sm font-medium text-gray-700">About</label>
                            <div class="mt-1">
                                <textarea
                                    id="about"
                                    name="about"
                                    rows="10"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    v-model="form.bio"
                                    @input="delete errors.bio && form.validate('bio')"
                                />
                            </div>
                            <InputError class="mt-2" :message="errors.bio || form.errors.bio" />
                            <p class="mt-2 text-sm text-gray-500">Write a few sentences about yourself.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button
                    type="submit"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                    @click.prevent="saveProfileInformation"
                    :disabled="form.processing"
                    :class="{'opacity-50 cursor-not-allowed': form.processing}"
                >
                    Save
                </button>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Saved.</p>
                </Transition>
            </div>
        </div>
    </section>
</template>

<script>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { usePrecognitiveForm } from 'laravel-precognition-vue';
import {computed} from "vue";

export default {
    components: {
        InputError,
        InputLabel,
        PrimaryButton,
        TextInput,
        Link,
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
        }
    },
    data () {
        return {
            status: null,
            avatarPreview: null,
        };
    },
    setup(props) {
        const form = usePrecognitiveForm('patch', route('profile.update'), useForm({
            username: props.user.username,
            email: props.user.email,
            name: props.user.profile.name,
            bio: props.user.profile.bio,
            date_of_birth: props.user.profile.date_of_birth,
            phone: props.user.profile.phone,
        }));

        const avatarForm = useForm({
            avatar: null,
        });

        return {
            form, avatarForm
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
            });
        },
        uploadAvatarPreview(file) {
            this.avatarForm.avatar = file;
        },
        updateAvatar() {
            this.avatarForm.post(route('profile.avatar'), {
                preserveScroll: true,
                preserveState: false,
                onSuccess: () => {
                    this.form.avatar = null;
                },
            });
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
