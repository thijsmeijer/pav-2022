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
                        <InputLabel for="email" value="Email"/>
                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus
                                   autocomplete="username"/>
                        <InputError class="mt-2" :message="form.errors.email"/>
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password" value="Password"/>
                        <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                                   autocomplete="current-password"/>
                        <InputError class="mt-2" :message="form.errors.password"/>
                    </div>

                    <div class="block mt-4">
                        <label class="flex items-center">
                            <Checkbox name="remember" v-model:checked="form.remember"/>
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <Link
                            :href="route('register')"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        >
                            No account?
                        </Link>

                        <PrimaryButton
                            class="ml-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            @click.prevent="submit"
                        >
                            Sign In
                        </PrimaryButton>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/FormElements/InputError.vue';
import InputLabel from '@/Components/FormElements/InputLabel.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import TextInput from '@/Components/FormElements/TextInput.vue';
import Checkbox from '@/Components/FormElements/Checkbox.vue';
import ApplicationLogo from "@/Components/Logos/ApplicationLogo.vue";

export default {
    name: "Login",
    components: {
        Head,
        Link,
        InputError,
        InputLabel,
        TextInput,
        PrimaryButton,
        Checkbox,
        ApplicationLogo
    },
    props: {
      canResetPassword: {
          type: Boolean
      },
      status: {
          type: String
      }
    },
    setup () {
        const form = useForm({
            email: '',
            password: '',
            remember: false
        });

        return { form }
    },
    methods: {
        submit() {
            this.form.post(route('login'), {
                onFinish: () => form.reset('password'),
            });
        }
    }
}
</script>

