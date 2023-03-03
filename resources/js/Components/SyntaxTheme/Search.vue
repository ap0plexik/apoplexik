<script setup>
import { ref, computed, toRaw } from "vue";
import { router } from "@inertiajs/vue3";
import {
  Combobox,
  ComboboxLabel,
  ComboboxInput,
  ComboboxOptions,
  ComboboxOption,
} from "@headlessui/vue";
import axios from "axios";

const selectedPost = ref(0);
const query = ref("");
const results = ref([]);

let getResults = async (query) => {
  const response = await axios.get(route("posts.search"), {
    params: { query: query },
  });
  results.value = response.data;
  return response.data;
};

let onSelected = (item) => {
  router.visit(route("posts.single", item.slug));
};
</script>
<template>
  <div>
    <!-- <button
      type="button"
      class="group flex h-6 w-6 items-center justify-center sm:justify-start md:h-auto md:w-80 md:flex-none md:rounded-lg md:py-2.5 md:pl-4 md:pr-3.5 md:text-sm md:ring-1 md:ring-slate-200 md:hover:ring-slate-300 dark:md:bg-slate-800/75 dark:md:ring-inset dark:md:ring-white/5 dark:md:hover:bg-slate-700/40 dark:md:hover:ring-slate-500 lg:w-96"
    >
      <svg
        aria-hidden="true"
        viewBox="0 0 20 20"
        class="h-5 w-5 flex-none fill-slate-400 group-hover:fill-slate-500 dark:fill-slate-500 md:group-hover:fill-slate-400"
      >
        <path
          d="M16.293 17.707a1 1 0 0 0 1.414-1.414l-1.414 1.414ZM9 14a5 5 0 0 1-5-5H2a7 7 0 0 0 7 7v-2ZM4 9a5 5 0 0 1 5-5V2a7 7 0 0 0-7 7h2Zm5-5a5 5 0 0 1 5 5h2a7 7 0 0 0-7-7v2Zm8.707 12.293-3.757-3.757-1.414 1.414 3.757 3.757 1.414-1.414ZM14 9a4.98 4.98 0 0 1-1.464 3.536l1.414 1.414A6.98 6.98 0 0 0 16 9h-2Zm-1.464 3.536A4.98 4.98 0 0 1 9 14v2a6.98 6.98 0 0 0 4.95-2.05l-1.414-1.414Z"
        ></path></svg
      ><span
        class="sr-only md:not-sr-only md:ml-2 md:text-slate-500 md:dark:text-slate-400"
        >Search docs</span
      >

      <kbd
        class="ml-auto hidden font-medium text-slate-400 dark:text-slate-500 md:block"
        ><kbd class="font-sans">⌘</kbd><kbd class="font-sans">K</kbd></kbd
      >
    </button> -->
    <Combobox as="div" v-model="selectedPost">
      <div class="relative mt-1">
        <!-- <svg
          aria-hidden="true"
          viewBox="0 0 20 20"
          class="h-5 w-5 flex-none fill-slate-400 group-hover:fill-slate-500 dark:fill-slate-500 md:group-hover:fill-slate-400"
        >
          <path
            d="M16.293 17.707a1 1 0 0 0 1.414-1.414l-1.414 1.414ZM9 14a5 5 0 0 1-5-5H2a7 7 0 0 0 7 7v-2ZM4 9a5 5 0 0 1 5-5V2a7 7 0 0 0-7 7h2Zm5-5a5 5 0 0 1 5 5h2a7 7 0 0 0-7-7v2Zm8.707 12.293-3.757-3.757-1.414 1.414 3.757 3.757 1.414-1.414ZM14 9a4.98 4.98 0 0 1-1.464 3.536l1.414 1.414A6.98 6.98 0 0 0 16 9h-2Zm-1.464 3.536A4.98 4.98 0 0 1 9 14v2a6.98 6.98 0 0 0 4.95-2.05l-1.414-1.414Z"
          ></path>
        </svg> -->
        <ComboboxInput
          :class="'bg-search bg-no-repeat bg-[length:20px_20px] bg-searchPos h-6 w-6 items-center justify-center h-auto w-80 flex-none md:rounded-lg md:py-2.5 md:pl-10 md:pr-3.5 text-slate-500 dark:text-slate-400 md:text-sm ring-1 ring-slate-200 hover:ring-slate-300 focus:ring-slate-300 dark:bg-slate-800/75 dark:ring-inset dark:ring-white/5 dark:hover:bg-slate-700/40 dark:hover:ring-slate-500 dark:focus:ring-slate-500 lg:w-96 border-none'"
		  :placeholder="'Search docs'"
          @change="getResults($event.target.value)"
        />

        <ComboboxOptions
          v-if="results.length"
          class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm text-slate-500 dark:text-slate-400 dark:md:bg-slate-800"
        >
          <ComboboxOption
            v-for="item in results"
            :key="item.id"
            :value="item"
            as="template"
            v-slot="{ active }"
          >
            <li
              v-if="item.title"
              :class="[
                'relative cursor-default select-none py-2 pl-8 pr-4',
                active
                  ? 'bg-sky-500 text-white cursor-pointer'
                  : 'text-slate-500 dark:text-slate-400',
              ]"
              @mousedown="onSelected(item)"
            >
              <span
                class="block truncate font-bold mb-2 text-slate-900 dark:text-white"
              >
                {{ item.title }}
              </span>
              <span class="block truncate">{{ item.body }}</span>
            </li>
          </ComboboxOption>
        </ComboboxOptions>
      </div>
    </Combobox>
  </div>
</template>


