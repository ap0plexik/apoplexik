<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {
  Dialog,
  DialogPanel,
  DialogTitle,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
import ButtonPrimary from "@/Components/ButtonPrimary.vue";
import Button from "@/Components/Button.vue";
import ButtonDanger from "@/Components/ButtonDanger.vue";
import InputNumber from "@/Components/InputNumber.vue";
import TextInput from "@/Components/TextInput.vue";
import Textarea from "@/Components/Textarea.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import { ref, computed } from "vue";

const toast = useToast();

const truncate = computed(() => {
  return (text, length, clamp) => {
    clamp = clamp || "...";
    let node = document.createElement("div");
    node.innerHTML = text;
    let content = node.textContent;
    return content.length > length ? content.slice(0, length) + clamp : content;
  };
});

let props = defineProps({
  posts: Object,
  categories: Object,
});

let form = useForm({
  id: "",
  title: "",
  body: "",
  order: 0,
  category_id: 0,
});

const formOrder = computed({
  get() {
    return form.order.toString();
  },
  set(newVal) {
    form.order = Number(newVal);
  },
});

let modalIsOpen = ref(false);
let editMode = ref(false);

let openModal = () => {
  modalIsOpen.value = true;
};

let closeModal = () => {
  modalIsOpen.value = false;
  editMode.value = false;
  form.reset();
};

let setPostToForm = (post) => {
  form.id = post.id;
  form.title = post.title;
  form.body = post.body;
  form.order = post.order;
  form.category_id = post.category_id;
};

let createPost = () => {
  form.reset();
  editMode.value = true;
  openModal();
};

let editPost = (post) => {
  setPostToForm(post);
  editMode.value = true;
  openModal();
};

let updatePost = () => {
  form.post(route("posts.update"), {
    onSuccess: (page) => {
      if (page.props.errors && Object.keys(page.props.errors).length === 0) {
        toast.success("Post Updated");
        form.reset();
        closeModal();
      } else {
        toast.error("Post Update Failed");
      }
    },
    onError: (page) => {
      toast.error("Post Update Failed");
    },
  });
};

let deletePost = (post) => {
  if (!confirm("Are you sure want to remove this post?")) return;
  setPostToForm(post);
  form.post(route("posts.delete"), {
    onSuccess: (page) => {
      if (page.props.errors && Object.keys(page.props.errors).length === 0) {
        toast.success("Post Deleted");
        form.reset();
        closeModal();
      } else {
        toast.error("Post Deletion Failed");
      }
    },
    onError: (page) => {
      toast.error("Post Deletion Failed");
    },
  });
};
</script>
<template>
  <div>
    <Head title="Manage Posts" />
    <app-layout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Manage Posts
        </h2>
      </template>

      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div
            class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4"
          >
            <div class="px-4 sm:px-6 lg:px-8">
              <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                  <h1 class="text-base font-semibold leading-6 text-gray-900">
                    Posts
                  </h1>
                  <p class="mt-2 text-sm text-gray-700">You know what to do.</p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                  <ButtonPrimary
                    @click="createPost"
                    :class="'mb-4'"
                    :type="'button'"
                  >
                    Create New Post
                  </ButtonPrimary>
                </div>
              </div>
              <div class="mt-8 flow-root">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div
                    class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
                  >
                    <table class="min-w-full divide-y divide-gray-300">
                      <thead>
                        <tr>
                          <th
                            scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"
                          >
                            ID
                          </th>
                          <th
                            scope="col"
                            class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900"
                          >
                            Title
                          </th>
                          <th
                            scope="col"
                            class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900"
                          >
                            Body
                          </th>
						  <th
                            scope="col"
                            class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900"
                          >
                            Category
                          </th>
                          <th
                            scope="col"
                            class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900"
                          >
                            Order
                          </th>
                          <th
                            scope="col"
                            class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900"
                          >
                            <span class="sr-only">Edit</span>
                          </th>
                          <th
                            scope="col"
                            class="relative py-3.5 pl-3 pr-4 sm:pr-0"
                          >
                            <span class="sr-only">Delete</span>
                          </th>
                        </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-200">
                        <tr v-for="(post, index) in posts" v-bind:key="index">
                          <td
                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-500 sm:pl-0"
                          >
                            {{ post.id }}
                          </td>
                          <td
                            class="whitespace-nowrap py-4 px-3 text-sm font-medium text-gray-900"
                          >
                            {{ post.title }}
                          </td>
                          <td
                            class="whitespace-nowrap py-4 px-3 text-sm text-gray-500"
                          >
                            {{ truncate(post.body, 50) }}
                          </td>
						  <td
                            class="whitespace-nowrap py-4 px-3 text-sm text-gray-500"
                          >
                            {{ post.category?.name }}
                          </td>
                          <td
                            class="whitespace-nowrap py-4 px-3 text-sm text-gray-500"
                          >
                            {{ post.order.toString() }}
                          </td>
                          <td
                            class="whitespace-nowrap py-4 px-3 text-sm text-gray-500"
                          >
                            <Button
                              type="button"
                              :class="'mr-2'"
                              @click="editPost(post)"
                            >
                              Edit
                            </Button>
                          </td>
                          <td
                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0"
                          >
                            <ButtonDanger
                              type="button"
                              @click="deletePost(post)"
                            >
                              Delete
                            </ButtonDanger>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <TransitionRoot as="template" :show="modalIsOpen">
              <Dialog
                as="div"
                class="relative z-10"
                @close="modalIsOpen = false"
              >
                <TransitionChild
                  as="template"
                  enter="ease-out duration-300"
                  enter-from="opacity-0"
                  enter-to="opacity-100"
                  leave="ease-in duration-200"
                  leave-from="opacity-100"
                  leave-to="opacity-0"
                >
                  <div
                    class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                  />
                </TransitionChild>

                <div class="fixed inset-0 z-10 overflow-y-auto">
                  <div
                    class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"
                  >
                    <TransitionChild
                      as="template"
                      enter="ease-out duration-300"
                      enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                      enter-to="opacity-100 translate-y-0 sm:scale-100"
                      leave="ease-in duration-200"
                      leave-from="opacity-100 translate-y-0 sm:scale-100"
                      leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    >
                      <DialogPanel
                        class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl"
                      >
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                          <div class="sm:flex sm:items-start">
                            <div
                              class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full"
                            >
                              <DialogTitle
                                as="h3"
                                class="text-base font-semibold leading-6 text-gray-900 mb-8"
                                >Edit Post</DialogTitle
                              >
                              <div class="mt-2">
                                <form>
                                  <div class="mb-6">
                                    <label
                                      for="PostTitleInput"
                                      class="block text-gray-700 text-sm font-bold mb-2"
                                      >Title</label
                                    >
                                    <TextInput
                                      type="text"
                                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                      id="PostTitleInput"
                                      placeholder="Enter Title"
                                      v-model="form.title"
                                    />
                                  </div>
                                  <div class="mb-6">
                                    <label
                                      for="PostBodyInput"
                                      class="block text-gray-700 text-sm font-bold mb-2"
                                      >Body</label
                                    >
                                    <Textarea
                                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                      id="PostBodyInput"
                                      v-model="form.body"
                                      placeholder="Enter Body"
                                    />
                                  </div>
                                  <div class="mb-6">
                                    <label
                                      for="PostOrderInput"
                                      class="block text-gray-700 text-sm font-bold mb-2"
                                      >Order</label
                                    >
                                    <InputNumber
                                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                      id="PostOrderInput"
                                      v-model="formOrder"
                                      placeholder="0"
                                    />
                                  </div>
                                  <div class="mb-6">
                                    <label
                                      for="PostOrderInput"
                                      class="block text-gray-700 text-sm font-bold mb-2"
                                      >Category</label
                                    >
                                    <select v-model="form.category_id">
                                      <option
                                        v-for="(category, index) in categories"
                                        :key="index"
                                        :value="category.id"
                                      >
                                        {{ category.name }}
                                      </option>
                                    </select>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div
                          class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6"
                        >
                          <span
                            class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto"
                          >
                            <Button
                              wire:click.prevent="updatePost()"
                              type="button"
                              v-show="!editMode"
                              @click="updatePost()"
                            >
                              Save
                            </Button>
                          </span>
                          <span class="flex w-full sm:ml-3 sm:w-auto">
                            <ButtonPrimary
                              wire:click.prevent="updatePost()"
                              type="button"
                              v-show="editMode"
                              @click="updatePost()"
                            >
                              Update
                            </ButtonPrimary>
                          </span>
                          <span class="mt-3 flex w-full sm:mt-0 sm:w-auto">
                            <Button @click="closeModal()" type="button">
                              Cancel
                            </Button>
                          </span>
                        </div>
                      </DialogPanel>
                    </TransitionChild>
                  </div>
                </div>
              </Dialog>
            </TransitionRoot>
          </div>
        </div>
      </div>
    </app-layout>
  </div>
</template>
