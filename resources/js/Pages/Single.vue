<script setup>
import Syntax from "@/Layouts/Syntax.vue";
import NavLeft from "@/Components/SyntaxTheme/NavLeft.vue";
import NavRight from "@/Components/SyntaxTheme/NavRight.vue";
import Pagination from "@/Components/SyntaxTheme/Pagination.vue";
import { Head, Link } from "@inertiajs/vue3";
import { computed } from "vue";

let props = defineProps({
  post: Object,
  leftNavData: Object,
});
</script>

<template>
  <div>
    <Syntax :title="post.title">
	<article class="pb-8 mb-8 max-w-3xl border-b border-slate-200 pt-6 dark:border-slate-800">
		<header class="mb-9 bg-gradient-to-r from-indigo-200 via-sky-400 to-indigo-200 bg-clip-text text-transparent">
			<p v-if="post.category" class="mb-1 font-display text-sm font-medium text-sky-500">
				{{ post.category.name }}
			</p>
			<h1
				class="font-display text-3xl tracking-tight"
			>{{post.title}}
			</h1>
			<div v-if="post.featured_image" class="aspect-video mt-4 w-full bg-cover bg-center" v-bind:style="{ 'backgroundImage': 'url(' + post.featured_image + ')' }" ></div>
		</header>
		<div
		v-html="post.body"
		class="prose prose-slate max-w-none dark:prose-invert dark:text-slate-400 prose-headings:scroll-mt-28 prose-headings:font-display prose-headings:font-normal lg:prose-headings:scroll-mt-[8.5rem] prose-lead:text-slate-500 dark:prose-lead:text-slate-400 prose-a:font-semibold dark:prose-a:text-sky-400 prose-a:no-underline prose-a:shadow-[inset_0_-2px_0_0_var(--tw-prose-background,#fff),inset_0_calc(-1*(var(--tw-prose-underline-size,4px)+2px))_0_0_var(--tw-prose-underline,theme(colors.sky.300))] hover:prose-a:[--tw-prose-underline-size:6px] dark:[--tw-prose-background:theme(colors.slate.900)] dark:prose-a:shadow-[inset_0_calc(-1*var(--tw-prose-underline-size,2px))_0_0_var(--tw-prose-underline,theme(colors.sky.800))] dark:hover:prose-a:[--tw-prose-underline-size:6px] prose-pre:rounded-xl prose-pre:bg-slate-900 prose-pre:shadow-lg dark:prose-pre:bg-slate-800/60 dark:prose-pre:shadow-none dark:prose-pre:ring-1 dark:prose-pre:ring-slate-300/10 dark:prose-hr:border-slate-800"
		>
		</div>
	</article>
	  <template #leftNav>
		<NavLeft />
	  </template>
    </Syntax>
  </div>
</template>
