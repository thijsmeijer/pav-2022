<template>
    <div class="min-h-screen bg-gray-100 flex flex-col">
        <main class="h-full flex flex-col flex-grow">
            <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
                <div>
                    <a :href="route('dashboard')">
                        <ApplicationLogo class="w-64" />
                    </a>
                </div>
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <div>
                        <InputLabel for="username" value="Username" />

                        <TextInput
                            id="username"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.username"
                            @input="form.validate('username')"
                        />

                        <InputError class="mt-2" :message="form.errors.username" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="email" value="Email" />

                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            @input="form.validate('email')"
                        />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password" value="Password" />

                        <TextInput
                            id="password"
                            type="password"
                            class="mt-1 block w-full"
                            v-model="form.password"
                            @input="form.validate('password')"
                        />

                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password_confirmation" value="Confirm Password" />

                        <TextInput
                            id="password_confirmation"
                            type="password"
                            class="mt-1 block w-full"
                            v-model="form.password_confirmation"
                            @input="form.validate('password')"
                        />

                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <Link
                            :href="route('login')"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        >
                            Already registered?
                        </Link>

                        <PrimaryButton
                            class="ml-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            @click.prevent="submit"
                        >
                            Sign Up
                        </PrimaryButton>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { usePrecognitiveForm} from "laravel-precognition-vue";
import InputError from '@/Components/FormElements/InputError.vue';
import InputLabel from '@/Components/FormElements/InputLabel.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import TextInput from '@/Components/FormElements/TextInput.vue';
import ApplicationLogo from "@/Components/Logos/ApplicationLogo.vue";

export default {
    name: "Register",
    components: {
        ApplicationLogo,
        Head,
        Link,
        InputError,
        InputLabel,
        TextInput,
        PrimaryButton
    },
    setup () {
        const form = usePrecognitiveForm('post', route('register'), useForm({
            username: '',
            email: '',
            password: '',
            password_confirmation: '',
        }));

        return { form }
    },
    methods: {
        submit() {
            this.form.post(route('register'), {
                onFinish: () => form.reset('password', 'password_confirmation'),
            });
        }
    }
}
</script>
