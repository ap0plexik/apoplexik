<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({
  navData: Object,
});
</script>
<template>
	<!-- Left Nav-->

      <div class="hidden lg:relative lg:block lg:flex-none">
        <div
          class="absolute inset-y-0 right-0 w-[50vw] bg-slate-50 dark:hidden"
        ></div>
        <div
          class="absolute top-16 bottom-0 right-0 hidden h-12 w-px bg-gradient-to-t from-slate-800 dark:block"
        ></div>
        <div
          class="absolute top-28 bottom-0 right-0 hidden w-px bg-slate-800 dark:block"
        ></div>
        <div
          class="sticky top-[4.5rem] -ml-0.5 h-[calc(100vh-4.5rem)] overflow-y-auto overflow-x-hidden py-16 pl-0.5"
        >

          <nav class="text-base lg:text-sm w-64 pr-8 xl:w-72 xl:pr-16">
            <ul role="list" class="space-y-9">
              <li v-for="cat in navData" :key="cat.id">
                <h2
                  class="font-display font-medium text-slate-900 dark:text-white"
                >
                  {{ cat.name }}
                </h2>
                <ul
                  role="list"
                  class="mt-2 space-y-2 border-l-2 border-slate-100 dark:border-slate-800 lg:mt-4 lg:space-y-4"
                >
                  <li v-for="post in cat.posts" :key="post.id" class="relative">
					<Link :href="'/articles/' + post.slug" class="block w-full pl-3.5 before:pointer-events-none before:absolute before:-left-1 before:top-1/2 before:h-1.5 before:w-1.5 before:-translate-y-1/2 before:rounded-full text-slate-500 before:hidden before:bg-slate-300 hover:text-slate-600 hover:before:block dark:text-slate-400 dark:before:bg-slate-700 dark:hover:text-slate-300 transition">
					{{ post.title }}
					</Link>
                  </li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>
      </div>
	<!-- End Left Nav -->
</template>

<style>
.bg-dots-darker {
  background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
  .dark\:bg-dots-lighter {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
  }
}
</style>
