<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Task from '@/Components/Task.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';
 
defineProps(['tasks']);
const form = useForm({
    task_name: '',
});
</script>
 
<template>
    <Head title="Tasks" />
 
    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('tasks.store'), { onSuccess: () => form.reset() })">
                <textarea
                    v-model="form.task_name"
                    placeholder="Add a new Task"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                <InputError :task_name="form.errors.task_name" class="mt-2" />
                <PrimaryButton class="mt-4">Add Task</PrimaryButton>
            </form>
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <Task
                    v-for="task in tasks"
                    :key="task.id"
                    :task="task"
                />
            </div>

        </div>
    </AuthenticatedLayout>
</template>