<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Syntax from "@/Layouts/Syntax.vue";
import NavLeft from "@/Components/SyntaxTheme/NavLeft.vue";
import Pagination from "@/Components/SyntaxTheme/Pagination.vue";

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
  leftNavData: Object,
});
</script>

<template>
  <div>
	<Syntax title="Archive">
      <div>

        <article class="pb-8 mb-8 border-b border-slate-200 pt-6 dark:border-slate-800">
          <header class="mb-9 space-y-1">
            <h1
              class="font-display text-3xl tracking-tight text-slate-900 dark:text-white"
            >
             Home
            </h1>
          </header>
          <div
            class="prose prose-slate max-w-none dark:prose-invert dark:text-slate-400 prose-headings:scroll-mt-28 prose-headings:font-display prose-headings:font-normal lg:prose-headings:scroll-mt-[8.5rem] prose-lead:text-slate-500 dark:prose-lead:text-slate-400 prose-a:font-semibold dark:prose-a:text-sky-400 prose-a:no-underline prose-a:shadow-[inset_0_-2px_0_0_var(--tw-prose-background,#fff),inset_0_calc(-1*(var(--tw-prose-underline-size,4px)+2px))_0_0_var(--tw-prose-underline,theme(colors.sky.300))] hover:prose-a:[--tw-prose-underline-size:6px] dark:[--tw-prose-background:theme(colors.slate.900)] dark:prose-a:shadow-[inset_0_calc(-1*var(--tw-prose-underline-size,2px))_0_0_var(--tw-prose-underline,theme(colors.sky.800))] dark:hover:prose-a:[--tw-prose-underline-size:6px] prose-pre:rounded-xl prose-pre:bg-slate-900 prose-pre:shadow-lg dark:prose-pre:bg-slate-800/60 dark:prose-pre:shadow-none dark:prose-pre:ring-1 dark:prose-pre:ring-slate-300/10 dark:prose-hr:border-slate-800"
          >
            this is the Home text.
          </div>
        </article>
		<Pagination />
      </div>
    </Syntax>

    <!-- end body -->
  </div>
</template>
