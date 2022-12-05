<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Profile Information</h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Update your account's profile information and email address.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="username" value="Username" />

                <TextInput
                    id="username"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.username"
                    @change="delete errors.username && form.validate('username')"
                />

                <InputError class="mt-2" :message="errors.username || form.errors.username" />
            </div>

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    @change="delete errors.email && form.validate('email')"
                />

                <InputError class="mt-2" :message="errors.email || form.errors.email" />
            </div>

            <div v-if="!form.email_verified_at">
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    Your email address is unverified.
                    <button
                        type="button"
                        class="text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300"
                        @click="sendVerificationEmail"
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

            <div class="flex items-center gap-4">
                <button
                    type="submit"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                    @click="saveProfileInformation"
                    :disabled="form.processing"
                >
                    Save
                </button>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>

<script>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { usePrecognitiveForm } from 'laravel-precognition-vue';

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
    },
    data () {
        return {
            status: null,
        };
    },
    setup(props) {
        const form = usePrecognitiveForm('patch', route('profile.update'), useForm({
            username: props.user.data.username,
            email: props.user.data.email,
            email_verified_at: props.user.data.email_verified_at,
        }));

        return {
            form
        };
    },
    methods: {
        sendVerificationEmail() {
            Inertia.post(route('email.verification.send'));
            this.status = 'verification-link-sent';
        },
        saveProfileInformation() {
            this.form.submit({
                preserveScroll: true,
                preserveState: false,
            });
        }
    },
};
</script>
