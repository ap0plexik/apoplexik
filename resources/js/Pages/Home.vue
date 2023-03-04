<script setup>
import { Head, Link } from "@inertiajs/vue3";
import SyntaxFull from "@/Layouts/SyntaxFull.vue";
import NavLeft from "@/Components/SyntaxTheme/NavLeft.vue";
import Pagination from "@/Components/SyntaxTheme/Pagination.vue";
import BlockBg from "@/Components/SyntaxTheme/BlockBg.vue";
import { CalendarDaysIcon, HandRaisedIcon } from '@heroicons/vue/24/outline'

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
});
</script>

<template>
  <div>
	<SyntaxFull title="Home" :canLogin="canLogin" :canRegister="canRegister">
      <div>

        <article class="pb-8 mb-8 border-b border-slate-200 pt-6 dark:border-slate-800">
			<BlockBg>
				<div class="mx-auto grid max-w-2xl grid-cols-1 gap-y-16 gap-x-8 lg:max-w-none lg:grid-cols-2">
					<div class="max-w-xl lg:max-w-lg">
					<h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Subscribe to our newsletter.</h2>
					<p class="mt-4 text-lg leading-8 text-gray-300">Nostrud amet eu ullamco nisi aute in ad minim nostrud adipisicing velit quis. Duis tempor incididunt dolore.</p>
					<div class="mt-6 flex max-w-md gap-x-4">
						<label for="email-address" class="sr-only">Email address</label>
						<input id="email-address" name="email" type="email" autocomplete="email" required="" class="min-w-0 flex-auto rounded-md border-0 bg-white/5 px-3.5 py-2 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6" placeholder="Enter your email" />
						<button type="submit" class="flex-none rounded-md bg-indigo-500 py-2.5 px-3.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Subscribe</button>
					</div>
					</div>
					<dl class="grid grid-cols-1 gap-x-8 gap-y-10 sm:grid-cols-2 lg:pt-2">
					<div class="flex flex-col items-start">
						<div class="rounded-md bg-white/5 p-2 ring-1 ring-white/10">
						<CalendarDaysIcon class="h-6 w-6 text-white" aria-hidden="true" />
						</div>
						<dt class="mt-4 font-semibold text-white">Weekly articles</dt>
						<dd class="mt-2 leading-7 text-gray-400">Non laboris consequat cupidatat laborum magna. Eiusmod non irure cupidatat duis commodo amet.</dd>
					</div>
					<div class="flex flex-col items-start">
						<div class="rounded-md bg-white/5 p-2 ring-1 ring-white/10">
						<HandRaisedIcon class="h-6 w-6 text-white" aria-hidden="true" />
						</div>
						<dt class="mt-4 font-semibold text-white">No spam</dt>
						<dd class="mt-2 leading-7 text-gray-400">Officia excepteur ullamco ut sint duis proident non adipisicing. Voluptate incididunt anim.</dd>
					</div>
					</dl>
				</div>
			</BlockBg>
        </article>
      </div>
    </SyntaxFull>

    <!-- end body -->
  </div>
</template>
