<script setup>
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { useForm } from '@inertiajs/vue3';
import { watch } from 'vue';
import dayjs from 'dayjs';
const props = defineProps({
    contact: {
        type: Object,
        default: () => ({}),
    },
    deleteContactModalOpenState: {
        type: Boolean,
        required: true,
    },
});

const form = useForm({
    fullname: '',
    birthdate: '',
    relation: '',
    address: '',
    email: '',
    phone: '',
});

watch(() => props.contact, (newContact) => {
    if (newContact) {
        form.fullname = newContact.fullname;
        form.birthdate = newContact.birthdate;
        form.relation = newContact.relation;
        form.address = newContact.address;
        form.email = newContact.email ? newContact.email : 'No email';
        form.phone = newContact.phone ? newContact.phone : 'No phone';
    }
});

const emit = defineEmits(['close']);

const capitalize = (value) => {
    if (!value) return '';
    value = value.toString();
    return value.charAt(0).toUpperCase() + value.slice(1);
};

const closeModal = () => {
    emit('close');
    form.clearErrors();
    form.reset();
};
</script>

<template>
    <Modal :show="deleteContactModalOpenState" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">Delete Contact</h2>
            <br>
            <form
                @submit.prevent="form.delete(route('contacts.destroy', props.contact.id), { onSuccess: () => closeModal() })">
                <div class="space-y-6">
                    <h2 class="text-lg font-medium text-gray-900">
                        Are you sure you want to delete this contact?
                    </h2>

                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Full Name</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ form.fullname }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Birthdate</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ form.birthdate ? dayjs(form.birthdate).format('DD-MM-YYYY') : '' }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Relation</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ capitalize(form.relation) }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Phone Number</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ form.phone }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Email</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ form.email }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Address</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ form.address }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="flex justify-end space-x-2">
                        <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                        <DangerButton>Delete</DangerButton>
                    </div>
                </div>
            </form>
        </div>
    </Modal>
</template>