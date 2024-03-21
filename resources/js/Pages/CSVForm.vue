<script setup>
import Layout from "@/Layouts/Layout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Errors from "@/Components/Errors.vue";
import Success from "@/Components/Success.vue";
import ProgressBar from "@/Components/ProgressBar.vue";

const props = defineProps({
    success: {
        default: "",
    },
    errors: {
        default: [],
    },
});

const form = useForm({
    file: "null",
});

const submit = () => {
    form.post("/", form);
};
</script>

<template>
    <Head title="CSVForm" />

    <Layout>
        <div
            class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
            <h2
                class="font-semibold text-xl text-gray-800 leading-tight mb-4 text-center"
            >
                CSV Form
            </h2>

            <form @submit.prevent="submit" method="post">
                <input
                    id="file"
                    type="file"
                    accept=".csv"
                    required
                    @input="form.file = $event.target.files[0]"
                    class="border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:border-blue-500 mb-4 w-full"
                />

                <ProgressBar :progress="form.progress" />

                <PrimaryButton type="submit">Submit</PrimaryButton>
            </form>

            <Success :success="success" />

            <Errors :errors="errors" />
        </div>
    </Layout>
</template>
