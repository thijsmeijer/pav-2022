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
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                />

                <InputError class="mt-2" :message="form.errors.email" />
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

<!--                <div-->
<!--                    v-show="props.status === 'verification-link-sent'"-->
<!--                    class="mt-2 font-medium text-sm text-green-600 dark:text-green-400"-->
<!--                >-->
<!--                    A new verification link has been sent to your email address.-->
<!--                </div>-->
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

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
    },
    setup(props) {
        const form = useForm({
            name: props.user.data.name,
            email: props.user.data.email,
            email_verified_at: props.user.data.email_verified_at,
        });

        return {
            form,
        };
    },
    methods: {
        sendVerificationEmail() {
            Inertia.post(route('email.verification.send'));
        },
    },
};
</script>
