<script setup>
import { Head } from "@inertiajs/vue3";
import SiteHeader from "@/Components/SyntaxTheme/SiteHeader.vue";
import { computed } from "vue";

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  title: String,
});
</script>

<template>
  <div>
    <Head :title="title"/>
	<SiteHeader :canLogin="canLogin" :canRegister="canRegister" />

	<!--<Hero />-->

	<!-- Page Heading -->
	<header v-if="$slots.header" class="bg-white shadow">
		<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
			<slot name="header" />
		</div>
	</header>
    <!-- start body -->
    <div
      class="relative mx-auto flex max-w-8xl justify-center sm:px-2 lg:px-8 xl:px-12"
    >
      <!-- start main -->
      <main
        class="min-w-0 max-w-2xl flex-auto px-4 py-16 lg:max-w-full lg:pr-0 lg:pl-8 xl:px-16"
      >
        <slot />
      </main>
      <!-- end main -->
    </div>
    <!-- end body -->
  </div>
</template>
