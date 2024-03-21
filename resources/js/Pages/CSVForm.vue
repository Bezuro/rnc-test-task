<script setup>
import Layout from "@/Layouts/Layout.vue";
import { Head, useForm } from "@inertiajs/vue3";

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

                <div v-if="form.progress" class="relative">
                    <div
                        class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200"
                    >
                        <div
                            :style="{ width: form.progress.percentage + '%' }"
                            class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"
                        ></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-600">
                        <span>0%</span>
                        <span>{{ form.progress.percentage }}%</span>
                        <span>100%</span>
                    </div>
                </div>

                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline w-full"
                >
                    Submit
                </button>
            </form>

            <div
                v-if="success"
                class="bg-green-100 border border-green-400 text-green-700 mt-3 px-4 py-3 rounded relative"
                role="alert"
            >
                <strong class="font-bold">Success! </strong>
                <span class="block sm:inline">{{ success }}</span>
            </div>

            <div v-if="errors.length > 0">
                <div
                    v-if="errors"
                    v-for="(errorMessage, index) in errors"
                    :key="index"
                    class="bg-red-100 border border-red-400 text-red-700 mt-3 px-4 py-3 rounded relative"
                    role="alert"
                >
                    <strong class="font-bold">Error! </strong>
                    <span class="block sm:inline">{{ errorMessage }}</span>
                </div>
            </div>
        </div>
    </Layout>
</template>
